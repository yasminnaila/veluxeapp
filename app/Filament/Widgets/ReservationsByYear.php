<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservationsByYear extends ChartWidget
{
    // static sesuai parent
    protected static ?string $heading = 'Reservations By Year';

    // filter harus public (parent mendeklarasikan public)
    public ?string $filter = null;

    // static supaya tidak conflict dengan parent
    protected static ?string $maxHeight = '400px';
    protected static ?string $pollingInterval = null;
    protected static ?string $color = 'primary';

    protected function getType(): string
    {
        return 'bar';
    }

    // menyediakan dropdown tahun (10 tahun ke belakang sampai sekarang)
    protected function getFilters(): ?array
    {
        $current = (int) Carbon::now()->year;
        $years = [];

        for ($i = 0; $i < 10; $i++) {
            $y = $current - $i;
            $years[(string) $y] = (string) $y;
        }

        // Urut naik (optional): kembalikan array terbalik agar ascending
        return array_reverse($years, true);
    }

    // data untuk chart berdasar tahun terpilih
    protected function getData(): array
    {
        $year = $this->filter ?? (string) Carbon::now()->year;

        // ambil jumlah reservations per bulan untuk tahun terpilih
        $rows = DB::table('reservations')
            ->selectRaw('MONTH(check_in) as m, COUNT(*) as total')
            ->whereYear('check_in', $year)
            ->groupBy('m')
            ->orderBy('m')
            ->pluck('total', 'm')
            ->toArray();

        $labels = collect(range(1, 12))
            ->map(fn($m) => Carbon::createFromDate(null, $m, 1)->format('M'))
            ->toArray();

        $data = [];
        foreach (range(1, 12) as $m) {
            $data[] = isset($rows[$m]) ? (int) $rows[$m] : 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Reservations', // sesuai request: "Reservations"(bukan "Nights")
                    'data' => $data,
                    'backgroundColor' => array_fill(0, count($data), '#f97316'),
                    'borderColor'     => array_fill(0, count($data), '#d97706'),
                ],
            ],
            'labels' => $labels,
        ];
    }
}
