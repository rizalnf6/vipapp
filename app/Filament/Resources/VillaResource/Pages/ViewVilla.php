<?php

namespace App\Filament\Resources\VillaResource\Pages;

use Filament\Actions;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Support\Enums\MaxWidth;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\VillaResource;

class ViewVilla extends ViewRecord
{
    protected static string $resource = VillaResource::class;

       protected static string $view = 'filament.resources.villa-resource.pages.view-villa';

    // public function getMaxContentWidth(): MaxWidth
    // {
    //     return MaxWidth::Full;
    // }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('export')
                ->label('Export')
                ->action(fn () => $this->export()),
            Actions\EditAction::make(),
        ];
    }

    public function export()
    {
        $filename = str($this->record->name)->slug();
        try {

            $record = $this->record;

            $pdf = Pdf::loadview('pdf.export', compact('record'))
                ->setPaper('a4')
                ->setOption(['defaultFont' => 'sans-serif'])->output();
            return response()->streamDownload(
                fn () => print($pdf),
                $filename . '.pdf'
            );
        } catch (\Throwable $th) {
            Notification::make()
                ->danger()
                ->title('Oppss..')
                ->body($th->getMessage())
                ->send();
        }
    }

    //woi aku lanjut belajar dirumah
}
