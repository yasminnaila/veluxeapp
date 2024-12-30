<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Room;

class RoomStatistics extends Widget
{
    protected static string $view = 'filament.widgets.room-statistics';

    protected function getViewData(): array
    {
        $rooms = Room::withCount('reservations')
            ->orderBy('reservations_count', 'desc')
            ->take(5)
            ->get();

        return [
            'rooms' => $rooms,
        ];
    }
}
