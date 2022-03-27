<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acceptance extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'count', 'price', 'margin', 'selling_price', 'total_buying_price', 'storage_id'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }


}
