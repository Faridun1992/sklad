<?php

namespace App\Http\Controllers;

use App\Models\Movement;
use App\Models\Product;
use App\Models\ProductStorage;
use App\Models\Storage;
use Illuminate\Http\Request;

class MovementController extends Controller
{

    public function index()
    {
        $storages = Storage::all();
        $movements = Movement::with('storage1', 'storage2')->paginate(10);
        return view('movements.movements_main', compact('movements', 'storages'));
    }


    public function create(Request $request)
    {
        $storage1 = Storage::where('id', $request->storage_id)->first();
        $storage2 = Storage::where('id', $request->storage2_id)->first();
        return view('movements.movements_create', compact('storage1', 'storage2'));
    }


    public function store(Request $request, Movement $movement)
    {
        dd($request->all());
        return redirect()->route('movements.index');
    }


    public function show($id, Request $request)
    {
        $product = ProductStorage::where('product_id', $id)
            ->where('storage_id', $request->storage1_id)
            ->with('product', 'storage', 'product.unit')
            ->first();
        return response()->json($product);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
        //
    }


    public function search(Request $request)
    {
        abort_if(!$request->ajax(), 403);

        $data = Product::with('unit')
            ->when($request->has('products'), fn($query) => $query->whereNotIn('id', $request->products))
            ->with(['storages' => fn($query) => $query->where(fn($q) => $q->where('storage_id', $request->storage1_id)
                ->where('count', '>', 0))])
            ->whereHas('storages', fn($query) => $query->where('storage_id', $request->storage1_id)
                ->where('count', '>', 0))
            ->where(function ($q) use ($request) {
                $q->where('title', 'LIKE', '%' . $request->product . '%')
                    ->orWhere('code', 'LIKE', '%' . $request->product . '%');
            })->get();

        return response()->json($data);
    }
}
