<?php

namespace App\Filament\Resources\VillaResource\Pages;

use Filament\Actions;
use Filament\Support\Enums\MaxWidth;
use App\Filament\Resources\VillaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateVilla extends CreateRecord
{
    protected static string $resource = VillaResource::class;

    public function getMaxContentWidth(): MaxWidth
    {
        return MaxWidth::Full;
    }
}
