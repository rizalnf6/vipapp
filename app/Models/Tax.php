<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tax extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'registered_pe' => 'boolean'
    ];

    public function villa(): BelongsTo
    {
        return $this->belongsTo(Villa::class);
    }
}
