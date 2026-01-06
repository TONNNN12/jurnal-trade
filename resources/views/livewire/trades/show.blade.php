<div class="container">
    <h4 class="mb-4">Detail Trade</h4>

    <div class="card mb-3">
        <div class="card-body">
            <strong>{{ $trade->stock->code }}</strong> - {{ $trade->stock->name }}<br>
            Tanggal: {{ $trade->trade_date }}<br>
            Status: <span class="badge bg-secondary">{{ $trade->status }}</span>
        </div>
    </div>

    <div class="card mb-3">
        <table class="table mb-0">
            <tr><th>Entry</th><td>{{ number_format($trade->entry_price) }}</td></tr>
            <tr><th>Take Profit</th><td>{{ number_format($trade->take_profit) }}</td></tr>
            <tr><th>Stop Loss</th><td>{{ number_format($trade->stop_loss) }}</td></tr>
            <tr><th>Risk</th><td>{{ number_format(abs($trade->entry_price - $trade->stop_loss)) }}</td></tr>
            <tr><th>Reward</th><td>{{ number_format(abs($trade->take_profit - $trade->entry_price)) }}</td></tr>
            <tr>
                <th>RR</th>
                <td>
                    {{ round(
                        abs($trade->take_profit - $trade->entry_price) /
                        abs($trade->entry_price - $trade->stop_loss), 2
                    ) }}
                </td>
            </tr>
        </table>
    </div>

    <a href="{{ route('trades.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</div>
