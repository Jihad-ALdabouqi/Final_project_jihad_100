<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;   // ← هذا مهم!
use App\Models\Salon;

class Feedback extends Model
{
    protected $table = 'feedbacks';
    protected $fillable = ['user_id', 'salon_id', 'rating', 'comment'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function salon()
    {
        return $this->belongsTo(Salon::class);
    }
}

