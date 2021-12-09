<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $activity = Activity::where('id', $id)->firstOrFail();
        $user = User::where('id', $activity->causer_id)->firstOrFail();
        return view('logs.logs_show', compact('activity', 'user'));
    }
}
