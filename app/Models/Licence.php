<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Licence extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'renewal_date' => 'datetime'
    ];

    public function villa(): BelongsTo
    {
        return $this->belongsTo(Villa::class);
    }
}
