<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'sector',
    ];

    /**
     * 1 Stock memiliki banyak trade
     */
    public function trades()
    {
        return $this->hasMany(Trade::class);
    }
}
