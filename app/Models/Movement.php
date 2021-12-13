<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    use HasFactory;

    protected $fillable = [ 'storage1_id', 'storage2_id', 'comment', 'user_id'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function storage1()
    {
        return $this->belongsTo(Storage::class, 'storage1_id');
    }
    public function storage2()
    {
        return $this->belongsTo(Storage::class, 'storage2_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
