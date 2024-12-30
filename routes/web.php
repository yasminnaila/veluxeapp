<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportController;

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
