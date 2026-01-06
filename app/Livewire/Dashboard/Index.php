<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Trade;
use Illuminate\Support\Collection;

class Index extends Component {
    public function render() {
        $trades = Trade::where('user_id', auth()->id())
            ->where('status', 'closed')
            ->get();

        $totalTrade = $trades->count();
        $win  = $trades->where('result', 'win')->count();
        $loss = $trades->where('result', 'loss')->count();
        $be   = $trades->where('result', 'be')->count();

        $winRate = $totalTrade > 0
            ? round(($win / $totalTrade) * 100, 2)
            : 0;

        $totalPL = $trades->sum('profit_loss');

        $avgRR = round(
            $trades->avg(function ($trade) {
                $risk = abs($trade->entry_price - $trade->stop_loss);
                $reward = abs($trade->take_profit - $trade->entry_price);
                return $risk > 0 ? $reward / $risk : 0;
            }) ?? 0,
            2
        );

        return view('livewire.dashboard.index', [
    'totalTrade'  => $totalTrade,
    'win'         => $win,
    'loss'        => $loss,
    'be'          => $be,
    'winRate'     => $winRate,
    'totalPL'     => $totalPL,
    'avgRR'       => $avgRR,
    'equityCurve' => $this->equityCurve(),
 ]);
    }

    public function equityCurve(): Collection
    {
        $equity = 0;

        return Trade::where('user_id', auth()->id())
            ->where('status', 'closed')
            ->orderBy('exit_date')
            ->get()
            ->map(function ($trade) use (&$equity) {
                $pl = $trade->profit_loss;
                $equity += $pl;

                return [
                    'date'   => $trade->exit_date?->format('d M') ?? '-',
                    'equity'=> round($equity, 2),
                ];
            });
    }
}
