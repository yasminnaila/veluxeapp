<?php

namespace App\Filament\Resources\ReservationResource\Pages;

use App\Filament\Resources\ReservationResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Pages\Actions;
use App\Helpers\ActivityLogger;

class EditReservation extends EditRecord
{
    protected static string $resource = ReservationResource::class;


}
