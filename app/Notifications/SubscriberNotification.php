<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscriberNotification extends Notification
{
    use Queueable;

    public $productSlug;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($productSlug)
    {
        $this->productSlug = $productSlug;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('New Product added')
                    ->greeting('Dear Subscriber')
                    ->line('Thanks a lot of you for subscribe our application. A new product added a few minute ago. You can check the product.')
                    ->action('Check New Product', url('single-product/'.$this->productSlug))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
