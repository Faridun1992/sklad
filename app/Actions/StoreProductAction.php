<?php

namespace App\Actions;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Acceptance;
use App\Models\Product;

class StoreProductAction
{
    public function handle(ProductStoreRequest $request)
    {
        if ($request->hasFile('image')) {
            $newImageName = time() . '-' . $request->title . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $newImageName);
        }
        $product = Product::Create([
            'image' => $request->has('image') ? $newImageName : null,
            'title' => $request->title,
            'category_id' => $request->category_id,
            'unit_id' => $request->unit_id,
            'code' => $request->code,
            'vendor_code' => $request->vendor_code,
            'storage_id' => $request->storage_id
        ]);
        Acceptance::create([

            'count' => $request->count,
            'price' => $request->price,
            'margin' => $request->margin,
            'product_id' => $product->id,
        ]);
        /*if ($request->has('search_field_code')) {
            Acceptance::create([
                'count' => $request->count,
                'price' => $request->price,
                'margin' => $request->margin,
                'product_id' => $request->id,
            ]);


        }*/
    }
}
