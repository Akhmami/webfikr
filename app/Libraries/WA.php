<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Http;

class WA
{
    protected $token;
    protected $base_url;
    protected $channel;
    protected $template;
    public $user;

    public function __construct($user)
    {
        $this->token = config('wa.token');
        $this->base_url = config('wa.base_url');
        $this->channel = config('wa.channel');
        $this->template = config('wa.template');
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
        $phone = $this->user->firstMobilePhone->full_number ?? 0;
        $nominal = rupiah($data['payment_amount']);
        $url = 'https://apps.' . config('app.domain');

        sms($phone, "Terima kasih, pembayaran ananda {$this->user->name} sebesar {$nominal} telah berhasil, silahkan kunjungi {$url} untuk informasi lainnya. Semoga Allah berikan keberkahan rezeki kepada Ayah/Bunda.");

        $response = Http::withToken($this->token)->post($base_url, [
            'to_name' => 'Abun ' . $this->user->name,
            'to_number' => $phone ?? null,
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
}
