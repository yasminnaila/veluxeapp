<?php

namespace App\Filament\Resources\ReservationResource\Pages;

use App\Helpers\ActivityLogger;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ReservationResource;

class CreateReservation extends CreateRecord
{
    protected static string $resource = ReservationResource::class;

}
