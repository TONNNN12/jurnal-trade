<?php

namespace App\Livewire\Trades;

use Livewire\Component;
use App\Models\Trade;
use App\Models\Stock;

class Edit extends Component
{
    public Trade $trade;

    public $stock_id;
    public $trade_date;
    public $entry_price;
    public $take_profit;
    public $stop_loss;

    public function mount(Trade $trade)
    {
        abort_if($trade->status !== 'open', 403);

        $this->trade = $trade;

        $this->stock_id = $trade->stock_id;
        $this->trade_date = $trade->trade_date;
        $this->entry_price = $trade->entry_price;
        $this->take_profit = $trade->take_profit;
        $this->stop_loss = $trade->stop_loss;
    }

    public function update()
    {
        $this->validate([
            'stock_id' => 'required',
            'trade_date' => 'required|date',
            'entry_price' => 'required|numeric',
            'take_profit' => 'required|numeric|gt:entry_price',
            'stop_loss' => 'required|numeric|lt:entry_price',
        ]);

        $this->trade->update([
            'stock_id' => $this->stock_id,
            'trade_date' => $this->trade_date,
            'entry_price' => $this->entry_price,
            'take_profit' => $this->take_profit,
            'stop_loss' => $this->stop_loss,
        ]);

        return redirect()->route('trades.index')
            ->with('success', 'Trade berhasil di-update');
    }

    public function render()
    {
        return view('livewire.trades.edit', [
            'stocks' => Stock::orderBy('code')->get(),
        ]);
    }
}
