<?php

namespace App\Livewire\Trades;

use Livewire\Component;
use App\Models\Trade;

class Close extends Component
{
    public Trade $trade;
    public $closed_price;

    public function mount(Trade $trade)
    {
        abort_if($trade->status !== 'open', 404);
        $this->trade = $trade;
    }

    public function closeTrade()
    {
        $this->validate([
            'closed_price' => 'required|numeric|min:1',
        ]);

        $entry = $this->trade->entry_price;
        $pl = $this->closed_price - $entry;

        if ($pl > 0) {
            $result = 'win';
        } elseif ($pl < 0) {
            $result = 'loss';
        } else {
            $result = 'be';
        }

        $this->trade->update([
            'closed_price' => $this->closed_price,
            'closed_at' => now(),
            'profit_loss' => $pl,
            'result' => $result,
            'status' => 'closed',
        ]);

        return redirect()->route('trades.index')
            ->with('success', 'Trade berhasil di-close');
    }

    public function render()
    {
        return view('livewire.trades.close');
    }
}
