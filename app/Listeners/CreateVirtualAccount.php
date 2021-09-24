<?php

namespace App\Listeners;

use App\Events\Registered;
use App\Libraries\VA;
use Illuminate\Support\Facades\Mail;

class CreateVirtualAccount
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $va = new VA;
        $data = array(
            'trx_id' => $event->user['trx_id'],
            'trx_amount' => $event->user['trx_amount'],
            'billing_type' => $event->user['billing_type'],
            'datetime_expired' => date('c', strtotime($event->user['datetime_expired'])),
            'virtual_account' => $event->user['virtual_account'],
            'customer_name' => $event->user['customer_name'],
            'customer_email' => '',
            'customer_phone' => '',
        );

        $result = $va->create($data);
        if ($result['status'] !== '000') {
            $result['name'] = $event->user['customer_name'];
            Mail::raw(json_encode($result), function ($message) {
                $message->to('akhmami@gmail.com')
                    ->subject("PSB Gagal create VA");
            });
        }

        return $result;
    }
}
