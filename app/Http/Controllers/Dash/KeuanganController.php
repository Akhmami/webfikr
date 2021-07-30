<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Billing;
use App\Models\Biller;
use App\Models\CostReduction;

class KeuanganController extends Controller
{
    public function index()
    {
        $virtual_account = Billing::active()->count();
        $tagihan = Biller::active()->count();
        $keringanan = CostReduction::unused()->count();

        return view('dash.keuangan.index', [
            'virtual_account' => $virtual_account,
            'tagihan' => $tagihan,
            'keringanan' => $keringanan
        ]);
    }
}
