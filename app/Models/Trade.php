<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    public function user()
{
    return $this->belongsTo(User::class);
}

public function stock()
{
    return $this->belongsTo(Stock::class);
}

public function getRiskAttribute()
{
    return abs($this->entry_price - $this->stop_loss);
}

public function getRewardAttribute()
{
    return abs($this->take_profit - $this->entry_price);
}

public function getRrAttribute()
{
    return $this->reward / $this->risk;
}

public function getProfitAttribute()
{
    if (!$this->exit_price) return 0;

    return $this->position === 'buy'
        ? $this->exit_price - $this->entry_price
        : $this->entry_price - $this->exit_price;
}

}
