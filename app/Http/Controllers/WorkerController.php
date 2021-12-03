<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateWorkerRequest;
use App\Http\Requests\WorkerRequest;
use App\Models\Role;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkerController extends Controller
{

    public function index(Request $request)
    {
        if ($request->has('status')) {
            $workers = Worker::where('status', false)
                ->with('role')
                ->latest()
                ->paginate(10);
            $current = 'Бывшие';
        } else {
            $workers = Worker::where('status', true)
                ->with('role')
                ->latest()
                ->paginate(10);
            $current = 'Текущие';
        }

        return view('workers.workers_main', compact('workers', 'current'));
    }


    public function create()
    {
        $roles = Role::all();
        return view('workers.workers_create', compact('roles'));
    }

    public function store(WorkerRequest $request, Worker $worker)
    {

        $worker->create($request->validated());
        return redirect()->route('workers.index')->with('status', 'Новый работник успешно добавлен');
    }

    public function edit(Worker $worker)
    {
        $worker->load('role');
        $roles = Role::all();
        return view('workers.workers_edit', compact('worker', 'roles'));
    }


    public function update(WorkerRequest $request, Worker $worker)
    {
        $worker->update($request->validated());
        return back()->with('status', "Сотрудник $worker->name успешно отредактирован");
    }

    public function destroy(Worker $worker)
    {
        $worker->delete();
        return back()->with('status', "Сотрудник(ца) $worker->name успешно удален(а)");
    }


}
