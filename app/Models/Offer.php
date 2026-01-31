<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'salon_id', 'name', 'required_coins', 'discount_percentage', 'is_active'
    ];

    public function salon()
    {
        return $this->belongsTo(Salon::class);
    }
}
