<?php

namespace App\Notifications\Deal;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DealApproved extends Notification
{
    use Queueable;

    private object $deal;

    /**
     * Create a new notification instance.
     */
    public function __construct($deal)
    {
        $this->deal = $deal;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject('Deal Approved')
            ->line('Your deal of has been approved.')
            ->line('Ref No:' . $this->deal->ref_no)
            ->action('View Deal', url('/deal/' . $this->deal->ref_no))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'title' =>'Your deal of has been approved.',
            'sub' => 'Ref No:' . $this->deal->ref_no,
            'link' => '/deal/' . $this->deal->ref_no,
        ];
    }
}
