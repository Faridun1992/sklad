<?php

namespace App\Http\Controllers;

use App\Filters\ProductFilter;
use App\Models\Movement;
use App\Models\Product;
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


    public function create()
    {
        $storages = Storage::all();
        return view('movements.movements_create', compact('storages'));
    }


    public function store(Request $request, Movement $movement)
    {
        //
    }


    public function show($id)
    {
        //
        return response()->json(Product::findOrFail($id)->load(['storages', 'unit']));
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function search(Request $request)
    {
        if (!$request->ajax()) {
            abort(403);
        }

        $data = Product::with('unit')
            ->with(['storages' => fn($query) => $query->where('storage_id', 'LIKE', '%' . $request->storage_id . '%')
                ->where('count', '>', 0)])
            ->whereHas('storages', fn($query) => $query->where('storage_id', 'LIKE', '%' . $request->storage_id . '%')
                ->where('count', '>', 0))
            ->where(function ($q) use ($request) {
                $q->where('title', 'LIKE', '%' . $request->product . '%')
                    ->orWhere('code', 'LIKE', '%' . $request->product . '%');
            });

        if ($request->has('products')) {
            $data->whereNotIn('id', $request->products);
        }

        return response()->json($data->get());
    }

    public function productForMovement($id)
    {
        $product = Product::findOrFail($id);

        $products = session()->get('products', []);

        if (isset($products[$id])) {
            $products[$id]['quantity']++;
        } else {
            $products[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price
            ];
        }

        session()->put('products', $products);
    }


}
