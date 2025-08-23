<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabai extends Model
{
    use HasFactory;
    public function komoditas()
    {
        return $this->hasMany(Komoditas::class, 'cabai_id');
    }
}
