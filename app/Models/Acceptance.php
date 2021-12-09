<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Acceptance extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['product_id', 'count', 'price', 'margin', 'selling_price', 'total_buying_price', 'storage_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('действие')
            ->logAll()
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "Приёмка $this->name был {$eventName}");
    }
}
