<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'salon_id', 'name', 'price', 'coin_cost', 'coins_earned', 'is_active', 'image', 'discount',
    ];

    public function salon()
    {
        return $this->belongsTo(Salon::class);
    }

    public function transactions()
    {
        return $this->hasMany(CoinTransaction::class);
    }
}
