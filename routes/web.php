<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportController;

Route::get('/', function () {
    return redirect('/admin/login');
});

Route::get('export-reservations', [ExportController::class, 'exportReservations'])
    ->name('export.reservations');

Route::get('export-reservations-pdf', [ExportController::class, 'exportReservationsPdf'])
    ->name('export.reservations.pdf');
