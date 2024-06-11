<?php

namespace App\Filament\Resources\VillaResource\Pages;

use Filament\Actions;
use App\Enums\Category;
use App\Enums\Roles;
use Filament\Support\Enums\MaxWidth;
use Filament\Resources\Components\Tab;
use App\Filament\Resources\VillaResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListVillas extends ListRecords
{
    protected static string $resource = VillaResource::class;

    public function getMaxContentWidth(): MaxWidth
    {
        return MaxWidth::Full;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $tabs = [
            'management' => Tab::make()
                ->label('Managed Villas')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereNull('deleted_at')->where('category', Category::Management)),
            'non_management' => Tab::make()
                ->label('Exclusively Marketed Villas')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereNull('deleted_at')->where('category', Category::NonManagement)),
            'all' => Tab::make()
                ->label('All')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereNull('deleted_at')),
        ];

        if (!getUser()->hasRole(Roles::USER)) {
            $tabs = array_merge($tabs, [
                'archived' => Tab::make()
                    ->label('Archived')
                    ->modifyQueryUsing(fn (Builder $query) => $query->onlyTrashed()),
            ]);
        }
        return $tabs;
    }
}
