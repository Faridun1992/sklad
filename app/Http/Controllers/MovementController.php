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
        if ($request->ajax()) {
            $data = Product::with('unit')
                ->with(['storages' => fn($query) => $query->where('storage_id', 'LIKE', '%' . $request->storage_id . '%')
                    ->where('count', '>', 0)])
                ->whereHas('storages', fn($query) => $query->where('storage_id', 'LIKE', '%' . $request->storage_id . '%')
                    ->where('count', '>', 0))
                ->where('title', 'LIKE', '%' . $request->product . '%')
                ->orWhere('code', 'LIKE', '%' . $request->product . '%')
                ->get();
            $output = '';

            if (count($data) > 0) {

                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';

                foreach ($data as $row) {

                    $output .=
                        "<li class='list-group-item' id='id'><a class='qwerty' data-id=".$row->id." href=".route('movements.create', ['storage_id' => $request->storage_id, 'storage2_id' => $request->storage2_id, 'product' => $row->id]).">"
                        . $row->title .
                        "</a></li>";
                }

                $output .= '</ul>';
            } else {

                $output .= '<li class="list-group-item">' . 'Ничего не найдено' . '</li>';
            }

            return $output;
        }

    }

    public function productForMovement($id)
    {
        $product = Product::findOrFail($id);

        $products = session()->get('products', []);

        if(isset($products[$id])) {
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
