<?php

namespace App\Filament\Resources\ActivityLogResource\Pages;

use App\Filament\Resources\ActivityLogResource;
use Filament\Resources\Pages\ListRecords;

class ListActivityLogs extends ListRecords
{
    protected static string $resource = ActivityLogResource::class;

    protected function getTableBulkActions(): array
    {
        return []; // Disable bulk delete
    }

    protected function getTableActions(): array
    {
        return []; // Disable row actions
    }
}
