<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Enums\Roles;
use Filament\Actions\DeleteAction;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected ?string $maxContentWidth = '4xl';

    protected function getActions(): array
    {
        return [
            DeleteAction::make()->hidden(fn () => !isSuperAdmin() || $this->record->hasRole(Roles::SUPER_ADMIN)),
        ];
    }
}
