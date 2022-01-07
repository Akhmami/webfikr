<?php

namespace App\Http\Livewire\Dash\Users;

use App\Models\Spp;
use Livewire\Component;

class SppUser extends Component
{
    public $grades;
    public $komitmen;
    public $user;

    protected $listeners = [
        'closeAlertValue' => '$refresh'
    ];

    public function mount($user)
    {
        $this->user = $user;
        $this->grades = $user->grades()
            ->with('spps')
            ->latest('nama')
            ->get();
    }

    public function render()
    {
        $this->komitmen = rupiah($this->user->setSpp->nominal ?? 0);
        return view('livewire.dash.users.spp-user');
    }

    public function minus($gradeId)
    {
        $spp = Spp::where('user_id', $this->user->id)
            ->where('grade_id', $gradeId)
            ->latest('id')->first();
        if (!empty($spp)) {
            $spp->delete();
        }
    }

    public function plus($gradeId)
    {
        $spp = Spp::where('user_id', $this->user->id)
            ->where('grade_id', $gradeId)
            ->latest('id')->first();

        if (!empty($spp)) {
            if (date('m', strtotime($spp->bulan)) != 6) {
                $bln = date('Y-m-d', strtotime('+1 month', strtotime($spp->bulan)));
                Spp::create([
                    'user_id' => $this->user->id,
                    'grade_id' => $gradeId,
                    'bulan' => $bln
                ]);
            }
        } else {
            Spp::create([
                'user_id' => $this->user->id,
                'grade_id' => $gradeId,
                'bulan' => date('Y-07-01')
            ]);
        }
    }
}
