<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;

class Worker extends Model
{
    use HasFactory, LogsActivity, CausesActivity;

    protected $fillable = ['name', 'email', 'phone', 'role_id', 'status'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('действие')
            ->logOnly(['name', 'email', 'phone', 'role.title', 'status'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "Сотрудник $this->name был {$eventName}");
    }
}
