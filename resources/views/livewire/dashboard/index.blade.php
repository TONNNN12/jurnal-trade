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
</div>
