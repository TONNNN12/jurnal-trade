<div class="container">
    <h4 class="mb-4">Close Trade</h4>

    <div class="card mb-3">
        <div class="card-body">
            <strong>{{ $trade->stock->code }}</strong><br>
            Entry: {{ number_format($trade->entry_price) }}<br>
            TP: {{ number_format($trade->take_profit) }}<br>
            SL: {{ number_format($trade->stop_loss) }}
        </div>
    </div>

    <form wire:submit.prevent="closeTrade">
        <div class="mb-3">
            <label>Harga Close</label>
            <input type="number"
                   class="form-control"
                   wire:model.live="closed_price">
            @error('closed_price') 
                <small class="text-danger">{{ $message }}</small> 
            @enderror
        </div>

        @if ($closed_price)
            <div class="alert alert-info">
                P/L: 
                <strong>
                    {{ number_format($closed_price - $trade->entry_price) }}
                </strong>
            </div>
        @endif

        <button class="btn btn-danger">
            Close Posisi
        </button>
    </form>
</div>
