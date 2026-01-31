<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\User;
use App\Models\Service;

class CoinRequestedNotification extends Notification
{
    use Queueable;

    protected $user;
    protected $service;

    public function __construct(User $user, Service $service)
    {
        $this->user = $user;
        $this->service = $service;
    }

    public function via($notifiable)
    {
        return ['database']; // نستخدم قاعدة البيانات فقط
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => '🆕 New Coin Request',
            'message' => $this->user->name . ' requested ' . $this->service->coins_earned . ' coins after using service: ' . $this->service->name,
            'url' => route('salon.owner.dashboard'),
            'user_id' => $this->user->id,
            'service_id' => $this->service->id,
            'created_at' => now(),
        ];
    }
}