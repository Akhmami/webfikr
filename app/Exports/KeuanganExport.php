<?php

namespace App\Exports;

use App\Exports\Sheets\UsersExport;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class KeuanganExport implements WithMultipleSheets
{
    use Exportable;

    private $year;
    private $month;

    public function __construct(int $year, int $month)
    {
        $this->year = $year;
        $this->month = $month;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];
        $relations = ['userDetail', 'mobilePhones'];

        foreach ($relations as $item) {
            $sheets[] = new UsersExport($item, $this->year, $this->month);
        }

        return $sheets;
    }
}
