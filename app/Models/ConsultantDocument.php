<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConsultantDocument extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function consultant(): BelongsTo
    {
        return $this->belongsTo(Consultant::class);
    }
}
