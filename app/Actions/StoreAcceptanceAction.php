<?php

namespace App\Actions;

use App\Http\Requests\AcceptanceRequest;
use App\Models\Acceptance;
use App\Models\Product;

class StoreAcceptanceAction
{
    public function handle(AcceptanceRequest $request, Acceptance $acceptance)
    {
        $product = Product::with(['storages' => fn($query) => $query->where('product_storage.storage_id', $request->storage_id)
            ->select('count')])
            ->where('id', $request->product_id)->first();

        $acceptance->create($request->validated() + [
                'selling_price' => ($request->price + ($request->price * $request->margin) / 100),
                'total_buying_price' => $request->price * $request->count
            ])->products()->attach($product);


        if (isset($product->storages[0]->count))
        {
            $product->storages()->updateExistingPivot($request->storage_id, [
                'count' => $product->storages[0]->count + $request->count
            ]);
        }
        else
        {
            $product->storages()->attach($request->storage_id, [
                'count' => $request->count,
            ]);
        }
    }
}
