<?php

namespace App\Http\Controllers;

use App\Models\Gelombang;
use Illuminate\Http\Request;

class MutasiController extends Controller
{
    public function index()
    {
        $conf = Gelombang::query()
            ->where('status', 'M')
            ->active()
            ->firstOrFail();

        $today = strtotime('today');
        $expiry = strtotime($conf->datetime_expired);
        $expired = false;

        if (is_null($conf->datetime_expired)) {
            return view('psb.comingsoon');
        }

        if ($today >= $expiry) {
            $expired = true;
        }

        return view('mutasi.index', [
            'expired' => $expired
        ]);
    }
}
