<?php

namespace App\Http\Livewire\Dash\Psb;

use App\Models\User;
use App\Models\Year;
use Livewire\Component;

class PsbStatCount extends Component
{
    public $stat_count;
    public $year;
    public $type;

    public function mount($type)
    {
        $this->year = Year::active()->first();
        $this->type = $type;
    }

    public function render()
    {
        if ($this->type == 'pendaftar') {
            $this->stat_count = [
                'SMA' => User::whereHas('userDetail', function ($query) {
                    $query->where('jenjang', 'SMA');
                })
                    ->where('tahun_pendaftaran', $this->year->periode)
                    ->count(),
                'SMP' => User::whereHas('userDetail', function ($query) {
                    $query->where('jenjang', 'SMP');
                })
                    ->where('tahun_pendaftaran', $this->year->periode)
                    ->count()
            ];
        }

        return view('livewire.dash.psb.psb-stat-count');
    }
}
