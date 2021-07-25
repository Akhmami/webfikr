<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentNotification extends Notification
{
    use Queueable;

    public $payment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($payment)
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
                    ->greeting('Assalaamu\'alaikum '. $this->payment['customer_name'])
                    ->line('Pembayaran terverifikasi dan telah kami terima')
                    ->line('Terimakasih, berikut informasi pembayaranmu:')
                    ->action('Riwayat Pembayaran', route('user.home'))
                    ->line('Jazakallah khoir, semoga Allah memberikan keberkahan dan kelancaran rizki.');
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
            'goto' => route('user.home'),
            'title' => 'Pembayaran terverifikasi',
            'description' => 'Pembayaranmu sudah kami terima, silahkan cek disini.'
        ];
    }
}
