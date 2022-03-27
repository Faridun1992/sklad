<?php

namespace App\Http\Controllers;

use App\Actions\StoreAcceptanceAction;
use App\Http\Requests\AcceptanceRequest;
use App\Models\Acceptance;
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

    public function store(AcceptanceRequest $request, Acceptance $acceptance, StoreAcceptanceAction $action)
    {
        $action->handle($request, $acceptance);
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
