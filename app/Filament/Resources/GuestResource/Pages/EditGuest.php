<?php

namespace App\Filament\Resources\GuestResource\Pages;

use App\Filament\Resources\GuestResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Helpers\ActivityLogger;

class EditGuest extends EditRecord
{
    protected static string $resource = GuestResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

}

