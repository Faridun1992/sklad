<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request)
    {
        if ($request->has('status')) {
            $users = User::where('status', false)
                ->with('roles')
                ->latest()
                ->paginate(10);
            $current = 'Бывшие';
        } else {
            $users = User::where('status', true)
                ->with('roles')
                ->latest()
                ->paginate(10);
            $current = 'Текущие';
        }
        return view('users.users_main', compact('users', 'current'));
    }


   /* public function create()
    {
        $roles = Role::all();
        return view('users.users_create', compact('roles'));
    }

    public function store(UserRequest $request, User $user)
    {

        $user->create($request->validated());
        $user->assignRole($request->role);
        return redirect()->route('users.index')->with('status', 'Новый работник успешно добавлен');
    }*/

    public function edit(User $user)
    {
        $user->load('roles');
        $roles = Role::all();
        return view('users.users_edit', compact('user', 'roles'));
    }


    public function update(UserRequest $request, User $user)
    {
        $user->update($request->validated());
        $user->syncRoles($request->role);

        return back()->with('status', "Сотрудник $user->name успешно отредактирован");
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('status', "Сотрудник(ца) $user->name успешно удален(а)");
    }


}
