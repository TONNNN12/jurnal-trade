<div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Jurnal Trade (Open)</h4>
        <a href="{{ route('trades.create') }}" class="btn btn-primary">
            + Tambah Trade
        </a>
    </div>

    {{-- FILTER --}}
    <div class="card card-body mb-3">
        <label>Filter Saham</label>
        <select class="form-control w-25" wire:model="stockId">
            <option value="">Semua</option>
            @foreach ($stocks as $stock)
                <option value="{{ $stock->id }}">
                    {{ $stock->code }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- TABLE --}}
    <div class="card">
        <table class="table table-bordered table-striped mb-0">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Saham</th>
                    <th>Entry</th>
                    <th>TP</th>
                    <th>SL</th>
                    <th>Risk</th>
                    <th>Reward</th>
                    <th>RR</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($trades as $trade)
                    @php
                        $risk = abs($trade->entry_price - $trade->stop_loss);
                        $reward = abs($trade->take_profit - $trade->entry_price);
                        $rr = $risk > 0 ? round($reward / $risk, 2) : 0;
                    @endphp

                    <tr>
                        <td>{{ $trade->trade_date }}</td>
                        <td>
                            <strong>{{ $trade->stock->code }}</strong><br>
                            <small>{{ $trade->stock->name }}</small>
                        </td>
                        <td>{{ number_format($trade->entry_price) }}</td>
                        <td>{{ number_format($trade->take_profit) }}</td>
                        <td>{{ number_format($trade->stop_loss) }}</td>
                        <td>{{ number_format($risk) }}</td>
                        <td>{{ number_format($reward) }}</td>
                        <td>
                            <span class="badge 
                                {{ $rr >= 2 ? 'bg-success' : 'bg-warning' }}">
                                {{ $rr }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('trades.close', $trade->id) }}" class="btn btn-sm btn-outline-danger">
                                Close
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted">
                            Belum ada trade
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
