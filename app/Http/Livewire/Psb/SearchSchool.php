<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Libraries\Kemdikbud;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchSchool extends Component
{
    public $perPage = 50;
    public $asal_sekolah;
    public $npsn;

    public function render()
    {
        $schools = [];
        if (strlen($this->asal_sekolah) > 3) {
            if (strpos($this->asal_sekolah, ' | ') !== false) {
                $this->npsn = explode(' | ', $this->asal_sekolah)[0];
            }

            $schools = $this->paginate(Kemdikbud::getNpsn($this->asal_sekolah), $this->perPage);
        }

        // dd($this->npsn);

        return view('livewire.search-school', [
            'schools' => $schools
        ]);
    }

    public function loadMore()
    {
        $this->perPage = $this->perPage + 5;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
