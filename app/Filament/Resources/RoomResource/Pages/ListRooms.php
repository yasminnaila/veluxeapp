<?php

namespace App\Filament\Resources\RoomResource\Pages;

use App\Filament\Resources\RoomResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Helpers\ActivityLogger;
use Filament\Tables;

class ListRooms extends ListRecords
{
    protected static string $resource = RoomResource::class;

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
