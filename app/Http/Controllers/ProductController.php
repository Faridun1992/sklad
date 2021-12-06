<?php

namespace App\Http\Controllers;

use App\Actions\StoreProductAction;
use App\Actions\UpdateProductAction;
use App\Filters\ProductFilter;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Storage;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    public function index(ProductFilter $filter, Request $request)
    {
        $request->has('search_field_code' || 'storage_id' || 'category_id' || 'search_field_vendor' || 'search_field_title') ?
            $products = Product::with( 'category')
                ->withSum('acceptances', 'count')
                ->withSum('acceptances', 'price')
                ->filter($filter, $request)
                ->latest()
                ->paginate(10) :
            $products = Product::with( 'category')
                ->withSum('acceptances', 'count')
                ->withSum('acceptances', 'price')
                ->latest()
                ->paginate(10);
        $storages = Storage::all();
        $categories = Category::all();
        return view('products.products_main', compact('products', 'categories', 'storages'));
    }


    public function create(ProductFilter $filter, Request $request)
    {
        $request->has('search_field_code') ?
            $product = Product::with('category', 'storage')
                ->filter($filter, $request)
                ->firstOrFail() :
            $product = '';
        $storages = Storage::all();
        $units = Unit::all();
        $categories = Category::all();
        return view('products.products_create', compact('storages', 'units', 'categories', 'product'));
    }


    public function store(ProductStoreRequest $request, StoreProductAction $action)
    {
        $action->handle($request);

        return redirect()->route('products.index')->with('status', 'Товар успешно добавлен');
    }


    public function edit(Product $product)
    {
        $product->load('category', 'storage');
        $categories = Category::all();
        $storages = Storage::all();
        $units = Unit::all();
        return view('products.product_edit', compact('product', 'categories', 'storages', 'units'));
    }


    public function update(UpdateProductAction $action, ProductUpdateRequest $request, Product $product)
    {
        $action->handle($request, $product);

        return back()->with('status', "Продукт $product->title успешно отредактирован");
    }


    public function destroy(Product $product)
    {
        if ($product->acceptances->count() > 0) {
            return back()->withErrors('Нельзя удалить');
        }
        $product->delete();

        return back()->with('status', "$product->title успешно удален");
    }

    public function deleteimage($id)
    {
        $product = Product::findOrFail($id);
        File::delete('images' . $product->image);
        $product->update([
            'image' => null,
        ]);
        return back()->with('status', 'Изоброжение успешно удаленно');
    }
}
