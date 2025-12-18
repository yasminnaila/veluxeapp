<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportController;
use App\Helpers\ActivityLogger;
use App\Exports\ReservationsExport;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Reservation;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('filament.pages.dashboard');
});

Route::get('export-reservations', [ExportController::class, 'exportReservations'])->name('export.reservations');

Route::get('export-reservations-pdf', [ExportController::class, 'exportReservationsPdf'])->name('export.reservations.pdf');

Route::get('/export/reservations', function () {
    ActivityLogger::log(
        'export_excel',
        null,
        'Export data reservasi ke Excel'
    );

    return Excel::download(new ReservationsExport, 'reservations.xlsx');
})->name('export.reservations');

Route::get('/export/reservations/pdf', function () {

    // Catat ke Activity Log
    ActivityLogger::log(
        'export_pdf',
        null,
        'Export data reservasi ke PDF'
    );

    // Ambil data
    $reservations = Reservation::with(['guests', 'room'])->get();

    // Load view dan kirim data
    $pdf = Pdf::loadView('exports.reservations', [
        'reservations' => $reservations,
    ]);

    // Download file
    return $pdf->download('reservations.pdf');
})->name('export.reservations.pdf');
