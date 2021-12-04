<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcceptanceRequest;
use App\Models\Acceptance;
use Illuminate\Http\Request;

class AcceptanceController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }

    public function store(AcceptanceRequest $request, Acceptance $acceptance)
    {
        $acceptance->create($request->validated());
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
