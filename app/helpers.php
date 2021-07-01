<?php

if (! function_exists('baseUrl')) {
    function baseUrl() {
        return config('app.base_url');
    }
}

// Tanggal Indonesia $date = yyyy-mm-dd
if (! function_exists('tanggal')) {
    function tanggal($date, $option = null)
    {
        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        if ($option === null) {
            $split = explode('-', $date);
            return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
        }

        return $bulan[ (int)$date ];
    }
}
