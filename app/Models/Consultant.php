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

    public function villa(): BelongsTo
    {
        return $this->belongsTo(Villa::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(ConsultantDocument::class, 'consultant_id');
    }
}
