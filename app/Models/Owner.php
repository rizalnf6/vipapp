<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Owner extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    protected $casts = [
        'passport_file' => 'array'
    ];

    public function villa(): BelongsTo
    {
        return $this->belongsTo(Villa::class);
    }
}
