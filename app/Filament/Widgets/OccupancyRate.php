<?php

namespace App\Filament\Widgets;

use App\Models\Reservation;
use App\Models\Room;
use Carbon\Carbon;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

class OccupancyRate extends Widget
{
    protected static string $view = 'filament.widgets.occupancy-rate';

    protected function getViewData(): array
    {
        $year = request()->query('year', Carbon::now()->year);

        // Avoid division by zero
        $totalRooms = Room::count() ?: 1;

        $reservationModel = new Reservation();
        $table = $reservationModel->getTable();

        /**
         * Helper: apply "not cancelled" filter safely
         * depending on available schema columns
         */
        $applyNotCancelled = function (Builder $query) use ($table) {
            if (Schema::hasColumn($table, 'status')) {
                $query->where('status', '!=', 'cancelled');
            } elseif (Schema::hasColumn($table, 'reservation_status')) {
                $query->where('reservation_status', '!=', 'cancelled');
            } elseif (Schema::hasColumn($table, 'is_cancelled')) {
                $query->where('is_cancelled', 0);
            } elseif (Schema::hasColumn($table, 'cancelled_at')) {
                $query->whereNull('cancelled_at');
            } elseif (Schema::hasColumn($table, 'deleted_at')) {
                $query->whereNull('deleted_at');
            }
            // If no cancellation indicator exists, treat all as active

            return $query;
        };

        $labels = [];
        $data   = [];

        for ($month = 1; $month <= 12; $month++) {
            $start = Carbon::create($year, $month, 1)->startOfMonth();
            $end   = (clone $start)->endOfMonth();

            // Reservations that overlap the current month
            $query = Reservation::where(function ($q) use ($start, $end) {
                $q->whereBetween('check_in', [$start, $end])
                  ->orWhereBetween('check_out', [$start, $end])
                  ->orWhere(function ($q2) use ($start, $end) {
                      $q2->where('check_in', '<=', $start)
                         ->where('check_out', '>=', $end);
                  });
            });

            // Apply safe cancellation filter
            $applyNotCancelled($query);

            // Count distinct occupied rooms
            $occupiedRooms = (int) $query
                ->distinct('room_id')
                ->count('room_id');

            $occupancyPercent = round(
                ($occupiedRooms / $totalRooms) * 100,
                2
            );

            $labels[] = $start->format('M');
            $data[]   = $occupancyPercent;
        }

        return [
            'labels' => $labels,
            'data'   => $data,
            'year'   => $year,
        ];
    }
}
