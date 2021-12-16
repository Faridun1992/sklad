<?php

namespace App\Http\Controllers;

use App\Filters\ProductFilter;
use App\Models\Movement;
use App\Models\Product;
use App\Models\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        dd($request->storage_id);
        return redirect()->route('movements.index');
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
        abort_if(!$request->ajax(), 403);

        $data = Product::with('unit')
            ->when($request->has('products'), fn($query) => $query->whereNotIn('id', $request->products))
            ->with(['storages' => fn($query) => $query->where('storage_id', 'LIKE', '%' . $request->storage_id . '%')
                ->where('count', '>', 0)])
            ->whereHas('storages', fn($query) => $query->where('storage_id', 'LIKE', '%' . $request->storage_id . '%')
                ->where('count', '>', 0))
            ->where(function ($q) use ($request) {
                $q->where('title', 'LIKE', '%' . $request->product . '%')
                    ->orWhere('code', 'LIKE', '%' . $request->product . '%');
            });

        return response()->json($data->get());
    }
}
