<?php

namespace App\Http\Controllers;

use App\Exports\ReservationsExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportReservations()
    {
        return Excel::download(new ReservationsExport, 'reservations.xlsx');
    }
}
