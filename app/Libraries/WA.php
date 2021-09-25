<?php

namespace App\Libraries;

use App\Models\User;
use Illuminate\Support\Facades\Http;

class WA
{
    protected $token;
    protected $base_url;
    protected $channel;
    protected $template;
    protected $template_psb;
    public $user;

    public function __construct(User $user)
    {
        $this->token = config('wa.token');
        $this->base_url = config('wa.base_url');
        $this->channel = config('wa.channel');
        $this->template = config('wa.template');
        $this->template_psb = config('wa.template_psb');
        $this->user = $user;
    }

    public function notifyPayment($data)
    {
        if (empty($data['template'])) {
            $data['template'] = $this->template;
        }

        $types = [
            'SPP' => 'SPP',
            'DKT' => 'DKT',
            'PSB' => 'PSB',
            'DUP' => 'Daftar Ulang PSB',
            'MUT' => 'Mutasi',
            'DUM' => 'Daftar Ulang Mutasi',
            'TOP' => 'Isi Saldo',
            'LAI' => 'Lainnya'
        ];
        $type = $types[substr($data['trx_id'], 0, 3)];
        $base_url = $this->base_url . '/v1/broadcasts/whatsapp/direct';
        $phone = $this->user->firstMobilePhone->full_number ?? '6287777833303';
        $nominal = rupiah($data['payment_amount']);
        $url = 'https://apps.' . config('app.domain');

        sms($phone, "Terima kasih, pembayaran ananda {$this->user->name} sebesar {$nominal} telah berhasil, silahkan kunjungi {$url} untuk informasi lainnya. Semoga Allah berikan keberkahan rezeki kepada Ayah/Bunda.");

        $response = Http::withToken($this->token)->post($base_url, [
            'to_name' => 'Abun ' . $this->user->name,
            'to_number' => $phone,
            'message_template_id' => $data['template'],
            'channel_integration_id' => $this->channel,
            'language' => [
                'code' => 'id'
            ],
            'parameters' => [
                'body' => [
                    [
                        'key' => '1',
                        'value' => 'type',
                        'value_text' => $type
                    ],
                    [
                        'key' => '2',
                        'value' => 'nama',
                        'value_text' => $this->user->name
                    ],
                    [
                        'key' => '3',
                        'value' => 'nominal',
                        'value_text' => $nominal
                    ],
                    [
                        'key' => '4',
                        'value' => 'url',
                        'value_text' => $url
                    ],
                ]
            ]
        ]);

        return $response;
    }

    public function notifyPsbRegistration($data)
    {
        $base_url = $this->base_url . '/v1/broadcasts/whatsapp/direct';
        $phone = $this->user->firstMobilePhone->full_number ?? '6287777833303';
        $nominal = rupiah($data['trx_amount']);
        $va = config('bsi.first_va_number') . $data['virtual_account'];

        $response = Http::withToken($this->token)->post($base_url, [
            'to_name' => 'Abun ' . $this->user->name,
            'to_number' => $phone,
            'message_template_id' => $this->template_psb,
            'channel_integration_id' => $this->channel,
            'language' => [
                'code' => 'id'
            ],
            'parameters' => [
                'body' => [
                    [
                        'key' => '1',
                        'value' => 'virtual_account',
                        'value_text' => $va
                    ],
                    [
                        'key' => '2',
                        'value' => 'nama',
                        'value_text' => $this->user->name
                    ],
                    [
                        'key' => '3',
                        'value' => 'trx_amount',
                        'value_text' => $nominal
                    ],
                    [
                        'key' => '4',
                        'value' => 'kode_bayar',
                        'value_text' => $data['virtual_account']
                    ],
                ]
            ]
        ]);

        return $response;
    }

    public function notifyPsbPaymentCompleted($data)
    {
        $base_url = $this->base_url . '/v1/broadcasts/whatsapp/direct';
        $phone = $this->user->firstMobilePhone->full_number ?? '6287777833303';
        $nominal = rupiah($data['payment_amount']);
        $url = 'https://apps.' . config('app.domain');

        $response = Http::withToken($this->token)->post($base_url, [
            'to_name' => 'Abun ' . $this->user->name,
            'to_number' => $phone,
            'message_template_id' => $this->template_psb,
            'channel_integration_id' => $this->channel,
            'language' => [
                'code' => 'id'
            ],
            'parameters' => [
                'body' => [
                    [
                        'key' => '1',
                        'value' => 'nama',
                        'value_text' => $this->user->name
                    ],
                    [
                        'key' => '2',
                        'value' => 'nominal',
                        'value_text' => $nominal
                    ],
                    [
                        'key' => '3',
                        'value' => 'url',
                        'value_text' => $url
                    ],
                ]
            ]
        ]);

        return $response;
    }
}
