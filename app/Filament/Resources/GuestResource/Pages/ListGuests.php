<?php

namespace App\Filament\Resources\GuestResource\Pages;

use App\Filament\Resources\GuestResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Helpers\ActivityLogger;
use Filament\Tables;

class ListGuests extends ListRecords
{
    protected static string $resource = GuestResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\EditAction::make(),
        ];
    }
}
