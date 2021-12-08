<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorageRequest;
use App\Models\Storage;
use Illuminate\Http\Request;

class StorageController extends Controller
{

    public function index()
    {
        $storages = Storage::orderBy('title')
            ->withSum('acceptances', 'total_buying_price')
            ->get();
        return view('storages.storages_main', compact('storages'));

    }


    public function create()
    {
        return view('storages.storages_create');
    }


    public function store(StorageRequest $request, Storage $storage)
    {
        $storage->create($request->validated());
        return redirect()->route('storages.index')->with('status', 'Новый склад успешно добавлен');
    }


    public function edit(Storage $storage)
    {
        return view('storages.storages_edit', compact('storage'));
    }


    public function update(StorageRequest $request, Storage $storage)
    {
        $storage->update($request->validated());
        return back()->with('status', "Склад $storage->title успешно отредактирован");
    }


    public function destroy(Storage $storage)
    {
        if ($storage->acceptances()->count()) {
            return back()->withErrors('Нельзя удалить');
        }
        $storage->delete();
        return back()->with('status', "Склад $storage->title  успешно уадален");
    }
}
