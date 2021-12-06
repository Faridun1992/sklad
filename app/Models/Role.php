<?php

namespace App\Models;

use Closure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Role extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['title'];

    public function workers()
    {
        return $this->hasMany(Worker::class);
    }
    public function setname(Closure $callback): self
    {
        $this->descriptionForEvent = $callback;

        return $this;
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('действия')
            ->logOnly(['title'])
            ->setDescriptionForEvent(fn(string $eventName) => "Роль $this->title был {$eventName}");
    }
}
