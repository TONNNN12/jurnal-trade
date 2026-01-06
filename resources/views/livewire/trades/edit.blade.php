<div class="container">
    <h4 class="mb-4">Edit Trade</h4>

    <form wire:submit.prevent="update">
        <div class="mb-3">
            <label>Saham</label>
            <select class="form-control" wire:model="stock_id">
                @foreach ($stocks as $stock)
                    <option value="{{ $stock->id }}">
                        {{ $stock->code }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" class="form-control" wire:model="trade_date">
        </div>

        <div class="mb-3">
            <label>Entry</label>
            <input type="number" class="form-control" wire:model.live="entry_price">
        </div>

        <div class="mb-3">
            <label>Take Profit</label>
            <input type="number" class="form-control" wire:model.live="take_profit">
        </div>

        <div class="mb-3">
            <label>Stop Loss</label>
            <input type="number" class="form-control" wire:model.live="stop_loss">
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('trades.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
