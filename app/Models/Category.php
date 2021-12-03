<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use HasFactory, LogsActivity ;

    protected $fillable = ['title'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('действия')
            ->logOnly(['title'])
            ->setDescriptionForEvent(fn(string $eventName) => "Категория $this->title был {$eventName}");
    }
}
