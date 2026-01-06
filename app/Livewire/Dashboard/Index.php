<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Trade;

class Index extends Component
{
    public function render()
    {
        $trades = Trade::where('user_id', auth()->id())
            ->where('status', 'closed')
            ->get();

        $totalTrade = $trades->count();
        $win = $trades->where('result', 'win')->count();
        $loss = $trades->where('result', 'loss')->count();
        $be = $trades->where('result', 'be')->count();

        $winRate = $totalTrade > 0
            ? round(($win / $totalTrade) * 100, 2)
            : 0;

        $totalPL = $trades->sum('profit_loss');

        $avgRR = $trades->avg(function ($trade) {
            $risk = abs($trade->entry_price - $trade->stop_loss);
            $reward = abs($trade->take_profit - $trade->entry_price);
            return $risk > 0 ? $reward / $risk : 0;
        });

        return view('livewire.dashboard.index', compact(
            'totalTrade',
            'win',
            'loss',
            'be',
            'winRate',
            'totalPL',
            'avgRR'
        ));
    }
}
