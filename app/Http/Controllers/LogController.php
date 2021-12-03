<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class LogController extends Controller
{
    public function index()
    {
        $activities = Activity::latest()->get();
        return view('logs.logs_main', compact('activities'));
    }

    public function show($id)
    {
        $activity = Activity::where('id', $id)->get();
        return view('logs.logs_show', compact('activity'));
    }
}
