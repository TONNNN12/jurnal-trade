<div>
    <h4 class="mb-3">Tambah Trade (BUY)</h4>

    <form wire:submit.prevent="save" class="card card-body">

        <div class="mb-3">
            <label>Saham</label>
            <select class="form-control" wire:model="stock_id">
                <option value="">-- Pilih Saham --</option>
                @foreach ($stocks as $stock)
                    <option value="{{ $stock->id }}">
                        {{ $stock->code }} - {{ $stock->name }}
                    </option>
                @endforeach
            </select>
            @error('stock_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Tanggal Trade</label>
            <input type="date" class="form-control" wire:model="trade_date">
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Entry</label>
                <input type="number" class="form-control" wire:model="entry_price">
            </div>

            <div class="col-md-4 mb-3">
                <label>Take Profit</label>
                <input type="number" class="form-control" wire:model="take_profit">
            </div>

            <div class="col-md-4 mb-3">
                <label>Stop Loss</label>
                <input type="number" class="form-control" wire:model="stop_loss">
            </div>
        </div>

        {{-- AUTO KALKULASI --}}
        <div class="row text-center mb-3">
            <div class="col">
                <strong>Risk</strong><br>
                {{ $risk }}
            </div>
            <div class="col">
                <strong>Reward</strong><br>
                {{ $reward }}
            </div>
            <div class="col">
                <strong>RR</strong><br>
                {{ $rr }}
            </div>
        </div>

        <div class="mb-3">
            <label>Catatan</label>
            <textarea class="form-control" wire:model.defer="notes"></textarea>
        </div>

        <button class="btn btn-success">Simpan Trade</button>
    </form>
</div>
