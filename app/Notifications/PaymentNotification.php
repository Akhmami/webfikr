<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\PaymentHistory;

class PaymentNotification extends Notification
{
    use Queueable;
    public $payment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(PaymentHistory $payment)
    {
        $this->payment = $payment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
                    ->line('Assalaamu\'alaikum '. $this->payment->user->name)
                    ->greeting('Pembayaran terverifikasi dan telah kami terima')
                    ->line('Terimakasih, berikut informasi pembayaranmu:')
                    ->action('Notification Action', url('/'))
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
            'goto' => route('home'),
            'title' => 'Pembayaranmu terverifikasi',
            'description' => 'Pembayaranmu sudah kami terima, silahkan cek disnini.'
        ];
    }
}
