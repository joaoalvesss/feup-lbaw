<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CartNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $product_id;
    /**
     * Create a new notification instance.
     */
    public function __construct($product_id)
    {
        $this->product_id = $product_id;
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
            'product_id' => $this->product_id,
            'message' => 'A product in your cart has changed price',
            'url' => '/products/' . $this->product_id,
        ];
    }
}
