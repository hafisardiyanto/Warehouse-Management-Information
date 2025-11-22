<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Komoditas extends Model
{
    use HasFactory;

 protected $fillable = [
        'cabai_id',
        'user_id',
        'gudang_id',
        'quantity',
        'status',
    ];

    public function cabai(): BelongsTo
    {
        return $this->belongsTo(Cabai::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function gudang(): BelongsTo
    {
        return $this->belongsTo(Gudang::class);
    }
}
