<?php

namespace App\Filament\Resources\GuestResource\Pages;

use App\Filament\Resources\GuestResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Helpers\ActivityLogger;

class CreateGuest extends CreateRecord
{
    protected static string $resource = GuestResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
