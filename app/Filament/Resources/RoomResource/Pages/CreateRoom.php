<?php

namespace App\Filament\Resources\RoomResource\Pages;

use App\Filament\Resources\RoomResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Helpers\ActivityLogger;

class CreateRoom extends CreateRecord
{
    protected static string $resource = RoomResource::class;

}
