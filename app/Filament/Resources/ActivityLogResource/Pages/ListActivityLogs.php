<?php

namespace App\Filament\Resources\ActivityLogResource\Pages;

use App\Filament\Resources\ActivityLogResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListActivityLogs extends ListRecords
{
    protected static string $resource = ActivityLogResource::class;

    protected function getActions(): array
    {
        return [
            Actions\Action::make('exportExcel')
                ->label('Export Excel')
                ->url(route('export.activity_logs.excel'))
                ->icon('heroicon-o-download')
                ->openUrlInNewTab(),
        ];
    }

    protected function getTableBulkActions(): array
    {
        return []; // Disable bulk actions
    }

    protected function getTableActions(): array
    {
        return []; // Disable row actions
    }
}
