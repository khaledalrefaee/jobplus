<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreateSubscreb extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

 

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'A new subscription has been created',
            'subscription_id' => $notifiable->id,
            'payment_type' => $notifiable->payment_type,
            'name_company' => $notifiable->company->name_company,
            'Number_of_opportunities' => $notifiable->plan->Number_of_opportunities,
            'price' => $notifiable->plan->price,

        ];
    }
}
