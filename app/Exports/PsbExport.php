<?php

namespace App\Exports;

use App\Exports\Sheets\RegisteredExport;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PsbExport implements WithMultipleSheets
{
    use Exportable;

    private $tahun_pendaftaran;

    public function __construct(int $tahun_pendaftaran)
    {
        $this->tahun_pendaftaran = $tahun_pendaftaran;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];
        $relations = ['userDetail', 'mobilePhones'];

        foreach ($relations as $item) {
            $sheets[] = new RegisteredExport($item, $this->tahun_pendaftaran);
        }

        return $sheets;
    }
}
