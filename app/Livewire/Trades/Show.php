<?php

namespace App\Livewire\Trades;

use Livewire\Component;
use App\Models\Trade;

class Show extends Component
{
    public Trade $trade;

    public function mount(Trade $trade)
    {
        $this->trade = $trade;
    }

    public function render()
    {
        return view('livewire.trades.show');
    }
}
