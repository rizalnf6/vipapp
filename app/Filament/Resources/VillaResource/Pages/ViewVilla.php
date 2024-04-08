<?php

namespace App\Filament\Resources\VillaResource\Pages;

use Filament\Actions;
use Filament\Support\Enums\MaxWidth;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\VillaResource;

class ViewVilla extends ViewRecord
{
    protected static string $resource = VillaResource::class;

    public function getMaxContentWidth(): MaxWidth
    {
        return MaxWidth::Full;
    }
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
