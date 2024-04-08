<?php

namespace App\Filament\Resources\VillaResource\Pages;

use Filament\Actions;
use Filament\Support\Enums\MaxWidth;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\VillaResource;

class EditVilla extends EditRecord
{
    protected static string $resource = VillaResource::class;

    public function getMaxContentWidth(): MaxWidth
    {
        return MaxWidth::Full;
    }
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
