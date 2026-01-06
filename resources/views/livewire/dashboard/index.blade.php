<div>
    <h3 class="mb-4">Dashboard Statistik</h3>

    <div class="row g-3">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <small>Total Trade</small>
                    <h3>{{ $totalTrade }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body text-success">
                    <small>Win</small>
                    <h3>{{ $win }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body text-danger">
                    <small>Loss</small>
                    <h3>{{ $loss }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body text-secondary">
                    <small>BE</small>
                    <h3>{{ $be }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-3">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <small>Win Rate</small>
                    <h3>{{ $winRate }}%</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <small>Total P/L</small>
                    <h3 class="{{ $totalPL >= 0 ? 'text-success' : 'text-danger' }}">
                        {{ number_format($totalPL) }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <small>Average RR</small>
                    <h3>{{ number_format($avgRR, 2) }}</h3>
                </div>
            </div>
        </div>
    </div>
    {{-- EQUITY CURVE --}}
<div class="mt-4">
    <div class="card">
        <div class="card-body">
            <h5 class="mb-3">📈 Equity Curve</h5>

            @if ($equityCurve->count() === 0)
                <p class="text-muted">Belum ada trade closed.</p>
            @else
                <canvas id="equityChart" height="100"></canvas>
            @endif
        </div>
    </div>
</div>
@if ($equityCurve->count() > 0)
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const equityData = @json($equityCurve);

        const labels = equityData.map(item => item.date);
        const data = equityData.map(item => item.equity);

        const ctx = document.getElementById('equityChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Equity',
                    data: data,
                    tension: 0.3,
                    borderWidth: 2,
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endif

</div>
