<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public function trades()
{
    return $this->hasMany(Trade::class);
}

}
