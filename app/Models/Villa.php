<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Villa extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'rental_date' => 'datetime',
        'lease_date' => 'datetime',
        'land_owner_ktp' => 'array',
    ];

    public function owner(): HasOne
    {
        return $this->hasOne(Owner::class);
    }

    public function tax(): HasOne
    {
        return $this->hasOne(Tax::class);
    }

    public function agreement(): HasOne
    {
        return $this->hasOne(Agreement::class);
    }

    public function insurance(): HasOne
    {
        return $this->hasOne(Insurance::class);
    }

    public function consultant(): HasOne
    {
        return $this->hasOne(Consultant::class);
    }

    public function others(): HasOne
    {
        return $this->hasOne(Other::class);
    }
}
