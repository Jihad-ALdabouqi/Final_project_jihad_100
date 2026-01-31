<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Salon;
use App\Models\CoinTransaction;
use App\Models\Feedback;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = ['name', 'email', 'password', 'phone', 'role'];

    public function salons()
    {
        return $this->hasMany(Salon::class, 'user_id');
    }

    public function coinTransactions()
    {
        return $this->hasMany(CoinTransaction::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}
