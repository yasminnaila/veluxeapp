<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Reservation;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Builder;

class OccupancyRate extends Widget
{
    protected static string $view = 'filament.widgets.occupancy-rate';

    protected function getViewData(): array
    {
        $year = request()->query('year', Carbon::now()->year);
        $totalRooms = Room::count() ?: 1;

        $reservationModel = new Reservation();
        $table = $reservationModel->getTable();

        // Helper: apply not-cancelled filter safely depending on schema
        $applyNotCancelled = function (Builder $query) use ($table) {
            if (Schema::hasColumn($table, 'status')) {
                $query->where('status', '!=', 'cancelled');
            } elseif (Schema::hasColumn($table, 'reservation_status')) {
                $query->where('reservation_status', '!=', 'cancelled');
            } elseif (Schema::hasColumn($table, 'is_cancelled')) {
                $query->where('is_cancelled', '=', 0);
            } elseif (Schema::hasColumn($table, 'cancelled_at')) {
                $query->whereNull('cancelled_at');
            } elseif (Schema::hasColumn($table, 'deleted_at')) {
                $query->whereNull('deleted_at');
            } else {
                // no cancellation marker found — do nothing (treat all as active)
            }

            return $query;
        };

        $labels = [];
        $data = [];

        for ($m = 1; $m <= 12; $m++) {
            $start = Carbon::create($year, $m, 1)->startOfMonth();
            $end = (clone $start)->endOfMonth();

            // Query reservations that overlap the month
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

            // Count unique occupied rooms for that month
            $occupiedRooms = (int) $query->distinct('room_id')->count('room_id');

            $occupancyPercent = round(($occupiedRooms / $totalRooms) * 100, 2);

            $labels[] = $start->format('M');
            $data[] = $occupancyPercent;
        }

        return [
            'labels' => $labels,
            'data' => $data,
            'year' => $year,
        ];
    }
}

