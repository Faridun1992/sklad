<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::withCount('workers')
            ->orderBy('title')
            ->get();

        return view('roles.role_main', compact('roles'));
    }


    public function create()
    {
        return view('roles.roles_create');
    }


    public function store(RoleRequest $request, Role $role)
    {
        $role = Role::create($request->validated());

        return redirect()->route('roles.index')->with('status', "Новая роль $role->title успешна добавлена");
    }



    public function edit(Role $role)
    {
        return view('roles.roles_edit', compact('role'));
    }


    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->validated());

        return back()->with('status', "Должность $role->title успешно отредактирована");
    }


    public function destroy(Role $role)
    {
        if ($role->workers->count() > 0) {
            return back()->withErrors('в данной должности есть сотрудники, нельзя удалить');
        } else {
            $role->delete();
            return back()->with('status', 'данная роль успешно удаленна');
        }
    }
}
