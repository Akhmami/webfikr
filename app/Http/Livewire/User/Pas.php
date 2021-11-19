<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class Pas extends Component
{
    public function render()
    {
        $user = auth()->user()->load('billerAnother', 'latestSpp', 'userDetail');
        $allow = true;

        if (strtotime($user->latestSpp->bulan) < strtotime('2021-11-01')) {
            $allow = false;
        }

        $tagihanLain = $user->billerAnother->sum('amount') - ($user->billerAnother->sum('cumulative_payment_amount') +
            $user->billerAnother->sum('cost_reduction') +
            $user->billerAnother->sum('balance_used'));

        if ($tagihanLain > 0) {
            $allow = false;
        }

        return view('livewire.user.pas', [
            'allow' => $allow,
            'cbt' => $this->fromCBT($user->userDetail->no_pendaftaran)
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
