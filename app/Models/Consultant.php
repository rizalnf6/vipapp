<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Consultant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'documents' => 'array'
    ];


    public function villa(): BelongsTo
    {
        return $this->belongsTo(Villa::class);
    }
}
