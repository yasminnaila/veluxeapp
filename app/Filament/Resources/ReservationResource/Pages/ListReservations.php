<?php

namespace App\Filament\Resources\ReservationResource\Pages;

use App\Filament\Resources\ReservationResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Pages\Actions;
use App\Helpers\ActivityLogger;

class ListReservations extends ListRecords
{
    protected static string $resource = ReservationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),

            Actions\Action::make('exportExcel')
                ->label('Export to Excel')
                ->url(route('export.reservations'))
                ->icon('heroicon-o-download'),

            Actions\Action::make('exportPdf')
                ->label('Export to PDF')
                ->url(route('export.reservations.pdf'))
                ->icon('heroicon-o-download'),

        ];
    }

    protected function deleteRecord($record): void
    {
        ActivityLogger::log(
            'deleted',
            $record,
            ActivityLogger::makeDeleteDescription($record, 'Menghapus reservasi'),
            ['data' => $record->toArray()]
        );

        parent::deleteRecord($record);
    }
}
