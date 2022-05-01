<?php

namespace App\Http\Livewire\User;

use App\Models\Eujian;
use Livewire\Component;

class Pas extends Component
{
    public function render()
    {
        $allow = true;
        $cbt = Eujian::query()
            ->where('no_peserta', auth()->user()->username)
            ->where('hak_akses', 1)
            ->first();

        if (!$cbt) {
            $allow = false;
        }

        return view('livewire.user.pas', [
            'allow' => $allow,
            'cbt' => $cbt
        ]);
    }

    public function fromCBT($no_psb)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://cbt.nfbs.or.id/index.php/api/user?no_psb=' . $no_psb,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }
}
