<?php

namespace App\Livewire\Trades;

use Livewire\Component;
use App\Models\Trade;
use App\Models\Stock;

class Create extends Component
{
    public $stock_id;
    public $trade_date;
    public $entry_price;
    public $take_profit;
    public $stop_loss;
    public $notes;

    // auto kalkulasi (readonly)
    public $risk = 0;
    public $reward = 0;
    public $rr = 0;

    protected $rules = [
        'stock_id'    => 'required|exists:stocks,id',
        'trade_date'  => 'required|date',
        'entry_price' => 'required|numeric|min:1',
        'take_profit' => 'required|numeric|min:1',
        'stop_loss'   => 'required|numeric|min:1',
        'notes'       => 'nullable|string',
    ];

    public function mount()
    {
        $this->trade_date = now()->toDateString();
    }

    public function updated($field)
    {
        if (in_array($field, ['entry_price', 'take_profit', 'stop_loss'])) {
            $this->calculate();
        }
    }

    private function calculate()
    {
        if ($this->entry_price && $this->take_profit && $this->stop_loss) {
            $this->risk = abs($this->entry_price - $this->stop_loss);
            $this->reward = abs($this->take_profit - $this->entry_price);

            $this->rr = $this->risk > 0
                ? round($this->reward / $this->risk, 2)
                : 0;
        }
    }

    public function save()
    {
        $this->validate();

        Trade::create([
            'user_id'     => auth()->id(),
            'stock_id'    => $this->stock_id,
            'trade_date'  => $this->trade_date,
            'position'    => 'buy', // BUY ONLY
            'entry_price' => $this->entry_price,
            'take_profit' => $this->take_profit,
            'stop_loss'   => $this->stop_loss,
            'notes'       => $this->notes,
            'status'      => 'open',
        ]);

        session()->flash('success', 'Trade berhasil disimpan');

        return redirect()->route('trades.index');
    }

    public function render()
    {
        return view('livewire.trades.create', [
            'stocks' => Stock::orderBy('code')->get(),
        ]);
    }
}
