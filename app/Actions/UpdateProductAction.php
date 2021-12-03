<?php

namespace App\Actions;

use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;

class UpdateProductAction
{
    public function handle(ProductUpdateRequest $request, Product $product)
    {
        if($request->hasFile('image')){
            $newImageName = time() . '-' . $request->title . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $newImageName);
            $product->update([
                'image' => $request->has('image') ? $newImageName : null,
                'title' => $request->title,
                'category_id' => $request->category_id,
                'code' => $request->code,
                'vendor_code' => $request->vendor_code,
                'storage_id' => $request->storage_id,
            ]);
        } else {
            $product->update([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'code' => $request->code,
                'vendor_code' => $request->vendor_code,
                'storage_id' => $request->storage_id,
            ]);
        }
    }
}
