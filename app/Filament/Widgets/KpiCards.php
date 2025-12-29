<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Reservation;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Builder;

class KpiCards extends Widget
{
    protected static string $view = 'filament.widgets.kpi-cards';

    protected function getViewData(): array
    {
        $today = Carbon::today();

        // 1) total reservasi hari ini (check_in pada hari ini)
        $totalReservationsToday = Reservation::whereDate('check_in', $today)->count();

        // Build base query for "active" reservations (overlap with today)
        $activeReservationsQuery = Reservation::whereDate('check_in', '<=', $today)
            ->whereDate('check_out', '>=', $today);

        // Exclude cancelled reservations depending on schema
        $reservationModel = new Reservation();
        $table = $reservationModel->getTable();

        // Helper to apply cancellation filter to a query builder
        $applyNotCancelled = function (Builder $query) use ($table) {
            // Priority order: status / reservation_status -> is_cancelled (bool) -> cancelled_at (datetime) -> deleted_at (soft deletes)
            if (Schema::hasColumn($table, 'status')) {
                // assume values like 'cancelled' or similar
                $query->where('status', '!=', 'cancelled');
            } elseif (Schema::hasColumn($table, 'reservation_status')) {
                $query->where('reservation_status', '!=', 'cancelled');
            } elseif (Schema::hasColumn($table, 'is_cancelled')) {
                // boolean flag 0/1
                $query->where('is_cancelled', '=', 0);
            } elseif (Schema::hasColumn($table, 'cancelled_at')) {
                $query->whereNull('cancelled_at');
            } elseif (Schema::hasColumn($table, 'deleted_at')) {
                // soft deletes: deleted_at not set means not deleted (not cancelled)
                $query->whereNull('deleted_at');
            } else {
                // no cancellation marker found — cannot exclude cancelled reservations reliably
                // fallback: do nothing (treat all reservations as active)
            }

            return $query;
        };

        // Apply cancellation filter to the base query
        $applyNotCancelled($activeReservationsQuery);

        // 2) total tamu menginap sekarang
        // If guest_count column exists, sum it. Else fallback to counting reservations (assume 1 guest per reservation)
        if (Schema::hasColumn($table, 'guest_count')) {
            $totalGuestsStaying = (int) $activeReservationsQuery->sum('guest_count');
        } elseif (Schema::hasColumn($table, 'guests')) {
            $totalGuestsStaying = (int) $activeReservationsQuery->sum('guests');
        } else {
            $totalGuestsStaying = (int) (clone $activeReservationsQuery)->count();
        }

        // 3) total kamar terisi saat ini (unique room_id pada active reservations)
        $totalRoomsOccupied = (int) (clone $activeReservationsQuery)->distinct('room_id')->count('room_id');

        // total rooms
        $totalRooms = Room::count();

        return [
            'totalReservationsToday' => $totalReservationsToday,
            'totalGuestsStaying' => $totalGuestsStaying,
            'totalRoomsOccupied' => $totalRoomsOccupied,
            'totalRooms' => $totalRooms,
        ];
    }
}
