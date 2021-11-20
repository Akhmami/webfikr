<?php

namespace App\Http\Controllers;

use App\Models\User;

class IDCardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $user = User::with('userDetail')->findOrFail($id);

        return view('user.pas-card', [
            'user' => $user,
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
