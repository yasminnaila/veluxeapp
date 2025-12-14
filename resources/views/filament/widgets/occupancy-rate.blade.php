<div class="filament-box p-4 rounded-lg shadow">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold">Occupancy Rate (Tahun {{ $year }})</h3>

        <form method="GET" class="flex items-center space-x-2">
            <select name="year" onchange="this.form.submit()" class="border rounded px-2 py-1">
                @for ($y = now()->year; $y >= now()->year - 5; $y--)
                    <option value="{{ $y }}" @if((int)$year === $y) selected @endif>{{ $y }}</option>
                @endfor
            </select>
        </form>
    </div>

    <canvas id="occupancyChart" width="400" height="200"></canvas>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    (function(){
        const ctx = document.getElementById('occupancyChart').getContext('2d');
        const labels = @json($labels);
        const data = @json($data);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Occupancy Rate (%)',
                    data: data,
                    fill: false,
                    tension: 0.2,
                    borderWidth: 2,
                    pointRadius: 4,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            callback: function(value) { return value + '%' }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y + '%';
                            }
                        }
                    }
                }
            }
        });
    })();
</script>
@endpush
