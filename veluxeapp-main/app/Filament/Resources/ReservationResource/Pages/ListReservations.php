<?php

namespace App\Filament\Resources\ReservationResource\Pages;

use App\Filament\Resources\ReservationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReservations extends ListRecords
{
    protected static string $resource = ReservationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('export')
                ->label('Export to Excel')
                ->url(route('export.reservations'))
                ->icon('heroicon-o-download'),
            Actions\Action::make('exportPdf')
                ->label('Export to PDF')
                ->url(route('export.reservations.pdf'))
                ->icon('heroicon-o-download'),
        ];
    }
}
