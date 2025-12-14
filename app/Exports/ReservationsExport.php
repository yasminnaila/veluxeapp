<?php

namespace App\Exports;

use App\Models\Reservation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReservationsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Reservation::with(['guests', 'room'])
            ->get()
            ->map(function ($reservation) {
                return [
                    'guest_name' => $reservation->guests->name,
                    'room_name' => $reservation->room->name,
                    'check_in' => $reservation->check_in,
                    'check_out' => $reservation->check_out,
                    'price' => $reservation->room->price,
                ];
            });
    }

    public function headings(): array
    {
        return ['Nama Penyewa', 'Nama Kamar', 'Check-In', 'Check-Out', 'Harga'];
    }
}
