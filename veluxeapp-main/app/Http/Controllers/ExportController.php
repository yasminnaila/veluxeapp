<?php

namespace App\Http\Controllers;

use App\Exports\ReservationsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Reservation;
use Mpdf\Mpdf;


class ExportController extends Controller
{
    public function exportReservations()
    {
        return Excel::download(new ReservationsExport, 'reservations.xlsx');
    }
    public function exportReservationsPdf()
    {
        $reservations = Reservation::with(['guests', 'room'])->get();

        $html = view('exports.reservations', compact('reservations'))->render();

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        return $mpdf->Output('reservations.pdf', 'D');
    }
}
