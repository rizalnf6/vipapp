<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Agreement extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'signed_copy' => 'boolean',
        'fix_monthly_fee' => 'boolean',
        'marketing_agent_sites' => 'array',
        'agreement_document' => 'array'
    ];

    public function villa(): BelongsTo
    {
        return $this->belongsTo(Villa::class);
    }
}
