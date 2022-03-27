<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'image', 'title',
        'category_id', 'unit_id',
        'code', 'vendor_code'];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function acceptances()
    {
        return $this->belongsToMany(Acceptance::class);
    }
    public function lastAcceptance()
    {
        return $this->belongsToMany(Acceptance::class)->latest();
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter, Request $request)
    {
        return $filter->apply($builder, $request);
    }

    public function storages()
    {
        return $this->belongsToMany(Storage::class)->withPivot('count');
    }

    public function movements()
    {
        return $this->belongsToMany(Movement::class);
    }

}
