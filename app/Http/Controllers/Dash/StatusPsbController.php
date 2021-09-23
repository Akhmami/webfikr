<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\StatusPsb;
use Illuminate\Http\Request;

class StatusPsbController extends Controller
{
    public function edit($id)
    {
        $stat = StatusPsb::findOrFail($id);

        return view('dash.psb.status-psb-edit', ['stat' => $stat]);
    }

    public function update(Request $request, $id)
    {
        $stat = StatusPsb::findOrFail($id);
        $stat->description = $request->description;
        $stat->save();

        return redirect(route('dash.psb.status-psb-index') . '#tab' . $stat->id);
    }
}
