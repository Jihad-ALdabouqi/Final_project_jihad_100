<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
     protected $fillable = [
        'name',
        'description',
        'location',
        'phone',      
        'email',      
        'admin_id',
        'image_path',
        'user_id',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    public function owner()
{
    return $this->belongsTo(User::class, 'user_id');
}
}