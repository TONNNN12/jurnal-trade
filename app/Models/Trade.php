<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trade extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'stock_id',
        'trade_date',
        'position',
        'entry_price',
        'take_profit',
        'stop_loss',
        'exit_price',
        'exit_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'trade_date' => 'date',
        'exit_date'  => 'date',
        'entry_price' => 'decimal:2',
        'take_profit' => 'decimal:2',
        'stop_loss'   => 'decimal:2',
        'exit_price'  => 'decimal:2',
    ];

    /* ======================
     |  RELATIONSHIPS
     |======================*/

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    /* ======================
     |  ACCESSORS (AUTO KALKULASI)
     |======================*/

    /**
     * Risk = |entry - stop_loss|
     */
    public function getRiskAttribute(): float
    {
        return abs($this->entry_price - $this->stop_loss);
    }

    /**
     * Reward = |take_profit - entry|
     */
    public function getRewardAttribute(): float
    {
        return abs($this->take_profit - $this->entry_price);
    }

    /**
     * Risk Reward Ratio
     */
    public function getRrAttribute(): float
    {
        if ($this->risk == 0) {
            return 0;
        }

        return round($this->reward / $this->risk, 2);
    }

    /**
     * Profit/Loss (sudah close)
     */
    public function getProfitAttribute(): float
    {
        if ($this->status !== 'closed' || !$this->exit_price) {
            return 0;
        }

        return $this->position === 'buy'
            ? $this->exit_price - $this->entry_price
            : $this->entry_price - $this->exit_price;
    }

    /**
     * Win / Lose
     */
    public function getIsWinAttribute(): bool
    {
        return $this->profit > 0;
    }
}
