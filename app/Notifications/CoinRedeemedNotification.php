<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
use App\Models\Service;

class CoinRedeemedNotification extends Notification
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
            'title' => '🎉 User Used Coins for Service',
            'message' => $this->user->name . ' used coins to get a discount on service: ' . $this->service->name,
            'url' => route('salon.owner.dashboard'),
            'user_id' => $this->user->id,
            'service_id' => $this->service->id,
            'created_at' => now(),
        ];
    }
}