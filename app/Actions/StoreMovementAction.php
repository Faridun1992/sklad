<?php

namespace App\Actions;

use App\Models\Movement;
use App\Models\ProductStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class StoreMovementAction
{
    public function handle(Request $request, Movement $movement)
    {
        $storage1 = ProductStorage::where('storage_id', $request->storage1_id)
            ->whereIn('product_id', $request->id)
            ->get();

        $sortedStorage1 = $this->sortLike($request, $storage1);

        foreach ($sortedStorage1 as $key1 => $item1) {
            $item1->update([
                'count' => $item1->count - $request->addCount[$key1]
            ]);
        }

        foreach ($request->id as $id) {
            ProductStorage::firstOrCreate([
                'product_id' => $id,
                'storage_id' => $request->storage2_id
            ]);
        }

        $storage2 = ProductStorage::where('storage_id', $request->storage2_id)
            ->whereIn('product_id', $request->id)
            ->get();

        $sortedStorage2 = $this->sortLike($request, $storage2);

        foreach ($sortedStorage2 as $key2 => $item2) {
            $item2->update([
                'count' => $item2->count + $request->addCount[$key2]
            ]);
        }
        $movement->create([
            'storage1_id' => $request->storage1_id,
            'storage2_id' => $request->storage2_id,
            'user_id' => 1,
            'comment' => $request->comment
        ])->products()->sync($request->id);

    }

    public function sortLike($request, $collection1)
    {
        $collection = new Collection();
        foreach ($request->id as $id) {
            $collection->push($collection1->firstWhere('product_id', $id));
        }
        return $collection;
    }

}
