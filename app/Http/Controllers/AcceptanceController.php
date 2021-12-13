<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcceptanceRequest;
use App\Models\Acceptance;
use App\Models\Product;
use App\Models\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AcceptanceController extends Controller
{

    public function index()
    {

    }


    public function create()
    {
        //
    }

    public function store(AcceptanceRequest $request, Acceptance $acceptance)
    {
        $acceptance->create($request->validated() + [
                'selling_price' => ($request->price + ($request->price * $request->margin) / 100),
                'total_buying_price' => $request->price * $request->count
            ]);
        $product = Product::where('id', $request->product_id)->first();
        foreach ($product->storages as $item) {

            if ($item->pivot->storage_id == $request->storage_id) {
                $product->storages()->updateExistingPivot($request->storage_id, [
                    'count' => $item->pivot->count + $request->count
                ]);
            } else {
                $product->storages()->attach($request->storage_id, [
                    'count' => $request->count,
                ]);
            }

        }


        return redirect()->route('products.index')->with('status', 'товар успешно добавлен');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
