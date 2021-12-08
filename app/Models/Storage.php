<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'address', 'status'];


    public function acceptances()
    {
        return $this->hasMany(Acceptance::class);
    }
}
