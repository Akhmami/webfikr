<?php

namespace App\Http\Controllers\Dash;

use App\Exports\KeuanganExport;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Billing;
use App\Models\Biller;
use App\Models\PaymentHistory;

class KeuanganController extends Controller
{
    public function index()
    {
        $virtual_account = Billing::active()->count();
        $tagihan = Biller::active()->count();
        $history = PaymentHistory::whereDate('datetime_payment', '>', Carbon::yesterday())->count();

        return view('dash.keuangan.index', [
            'virtual_account' => $virtual_account,
            'tagihan' => $tagihan,
            'history' => $history
        ]);
    }

    public function report()
    {
        return view('dash.keuangan.report');
    }
}
