<?php

namespace App\Libraries;

use App\Libraries\BsiHashing;

class VA
{
    private $client_id;
    private $secret_key;
    private $url;

    public function __construct()
    {
        $this->client_id = config('bsi.client_id');
        $this->secret_key = config('bsi.secret_key');
        $this->url = config('bsi.url');
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

    public function callback()
    {
        $data = file_get_contents('php://input');

        $data_json = json_decode($data, true);

        if (!$data_json) {
            // handling orang iseng
            return json_decode('{"status":"999","message":"jangan iseng :D"}', true);
        } else {
            if ($data_json['client_id'] === $this->client_id) {
                $data_asli = $this->parsing($data_json['data']);

                if (!$data_asli) {
                    // handling jika waktu server salah/tdk sesuai atau secret key salah
                    return json_decode('{"status":"999","message":"waktu server tidak sesuai NTP atau secret key salah."}', true);
                } else {
                    $data_asli['status'] = '000';
                    return $data_asli;
                }
            }
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
