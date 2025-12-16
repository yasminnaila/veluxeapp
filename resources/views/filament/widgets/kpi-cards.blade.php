<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="filament-box p-4 rounded-lg shadow">
        <div class="text-sm font-medium text-gray-500">Total Reservasi (Hari
Ini)</div>
        <div class="mt-2 text-3xl font-bold">{{ $totalReservationsToday }}</div>
        <div class="text-xs text-gray-400 mt-1">Check-in pada {{ now()->format('d
M Y') }}</div>
    </div>

    <div class="filament-box p-4 rounded-lg shadow">
        <div class="text-sm font-medium text-gray-500">Total Tamu Menginap
(Sekarang)</div>
        <div class="mt-2 text-3xl font-bold">{{ $totalGuestsStaying }}</div>
        <div class="text-xs text-gray-400 mt-1">Reservasi aktif</div>
    </div>

    <div class="filament-box p-4 rounded-lg shadow">
        <div class="text-sm font-medium text-gray-500">Kamar Terisi</div>
        <div class="mt-2 text-3xl font-bold">{{ $totalRoomsOccupied }} / {{
$totalRooms }}</div>
        <div class="text-xs text-gray-400 mt-1">Occupancy saat ini</div>
    </div>
</div>
