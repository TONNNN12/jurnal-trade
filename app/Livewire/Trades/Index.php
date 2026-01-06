<?php

namespace App\Livewire\Trades;

use Livewire\Component;
use App\Models\Trade;
use App\Models\Stock;

class Index extends Component
{
    public $stockId = '';

    public function render()
    {
        $trades = Trade::with('stock')
            ->where('user_id', auth()->id())
            ->where('status', 'open')
            ->when($this->stockId, function ($q) {
                $q->where('stock_id', $this->stockId);
            })
            ->latest('trade_date')
            ->get();

        return view('livewire.trades.index', [
            'trades' => $trades,
            'stocks' => Stock::orderBy('code')->get(),
        ]);
    }
}
