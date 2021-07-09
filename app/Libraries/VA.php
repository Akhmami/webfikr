<?php

namespace App\Libraries;

use App\Libraries\BsiHashing;

class VA
{
    private $client_id;
    private $secret_key;
    private $url;

    public function __construct($client_id, $secret_key)
    {
        if (config('app.env') == 'production') {
            $this->client_id = $client_id;
            $this->secret_key = $secret_key;
            $this->url = 'https://api.bni-ecollection.com/';
        } else {
            $this->client_id = config('bsi.client_id');
            $this->secret_key = config('bsi.secret_key');
            $this->url = 'https://billing-bpi-dev.maja.id/bni/register';
        }
    }

    public function create($data)
    {
        $data_asli = $data;
        $data_asli['type'] = 'createBilling';
        $data_asli['client_id'] = $this->client_id;
        // if (config('app.env') != 'production') {
        //     $data_asli['virtual_account'] = str_replace(substr($data['virtual_account'], 0, 8), '98810789', $data['virtual_account']);
        // }

        $res = $this->hashing($data_asli);

        if ($res['status'] !== '000') {
            // if failed
            return $res;
        } else {
            $response_json = $this->parsing($res['data']);
            $response_json['status'] = '000';
            return $response_json;
        }
    }

    public function update($data)
    {
        $data_asli = $data;
        $data_asli['type'] = 'updatebilling';
        $data_asli['client_id'] = $this->client_id;

        $res = $this->hashing($data_asli);

        if ($res['status'] !== '000') {
            // if failed
            return $res;
        } else {
            $response_json = $this->parsing($res['data']);
            $response_json['status'] = '000';
            return $response_json;
        }
    }

    public function inquiry($data)
    {
        $data_asli = $data;
        $data_asli['type'] = 'inquirybilling';
        $data_asli['client_id'] = $this->client_id;

        if (config('app.env') != 'production') {
            if (!empty($data['virtual_account'])) {
                $data_asli['virtual_account'] = str_replace(substr($data['virtual_account'], 0, 8), '98810789', $data['virtual_account']);
            }
        }

        $res = $this->hashing($data_asli);

        if ($res['status'] !== '000') {
            // if failed
            return $res;
        } else {
            $response_json = $this->parsing($res['data']);
            $response_json['status'] = '000';
            return $response_json;
        }
    }

    private function hashing($data_asli)
    {
        $hashed_string = BsiHashing::encrypt(
            $data_asli,
            $this->client_id,
            $this->secret_key
        );

        $data = array(
            'client_id' => $this->client_id,
            'data' => $hashed_string,
        );

        $response = get_content($this->url, json_encode($data));
        $response_json = json_decode($response, true);

        return $response_json;
    }

    private function parsing($res)
    {
        $response_json = BsiHashing::decrypt($res, $this->client_id, $this->secret_key);
        return $response_json;
    }
}
