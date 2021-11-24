<?php

function get_content($url, $post = '')
{
    $usecookie = __DIR__ . "/cookie.txt";
    $header[] = 'Content-Type: application/json';
    $header[] = "Accept-Encoding: gzip, deflate";
    $header[] = "Cache-Control: max-age=0";
    $header[] = "Connection: keep-alive";
    $header[] = "Accept-Language: en-US,en;q=0.8,id;q=0.6";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_VERBOSE, false);
    // curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_ENCODING, true);
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 5);

    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36");

    if ($post) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $rs = curl_exec($ch);

    if (empty($rs)) {
        var_dump($rs, curl_error($ch));
        curl_close($ch);
        return false;
    }
    curl_close($ch);
    return $rs;
}

if (!function_exists('baseUrl')) {
    function baseUrl()
    {
        return config('app.base_url');
    }
}

// Tanggal Indonesia $date = yyyy-mm-dd
if (!function_exists('tanggal')) {
    function tanggal($date, $option = null)
    {
        $bulan = array(
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
            return $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
        }

        return $bulan[(int)$date];
    }
}

if (!function_exists('rupiah')) {
    function rupiah($angka, $rp = true)
    {
        $convert = ($rp ? "Rp " : '') . number_format($angka, 0, '', '.');
        return $convert;
    }
}

if (!function_exists('range_month')) {
    function date_range($start, $end = null, $type = null)
    {
        if ($end === null) {
            $end = date('Y-m-02');
        }

        if ($type === null) {
            $type = '%m';
        }

        $start_date = new DateTime($start);
        $end_date = new DateTime($end);
        $diff = $start_date->diff($end_date);
        $month = $diff->format($type); // 1

        if (strtotime(date($start)) > strtotime(date($end))) {
            return '0';
        }

        return $month;
    }
}

/**
 * function for sending SMS
 */
function sms($mobile, $pesan)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'http://api.nusasms.com/api/v3/sendsms/plain',
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => array(
            'user' => 'nfbsserang_api',
            'password' => 'nfbsserang_api',
            'SMSText' => $pesan,
            'GSM' => $mobile
        )
    ));
    $resp = curl_exec($curl);
    curl_close($curl);

    if (!$resp) {
        return false;
    } else {
        return true;
    }
}

/**
 * function for sending SMS OTP
 */
function sms_otp($mobile, $pesan)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'http://api.nusasms.com/api/v3/sendsms/plain',
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => array(
            'user' => 'nfbsserang_api',
            'password' => 'nfbsserang_api',
            'SMSText' => $pesan,
            'GSM' => $mobile,
            'otp' => 'Y'
        )
    ));
    $resp = curl_exec($curl);
    curl_close($curl);
    if (!$resp) {
        return false;
    } else {
        return true;
    }
}

function set_active($route, $active = null, $default = null)
{
    if (is_array($route)) {
        return in_array(request()->route()->getName(), $route) ? $active : $default;
    }
    return request()->route()->getName() == $route ? $active : $default;
}

function str_excerpt($content, $length = 100, $end = '')
{
    if (!is_string($content)) {
        return 'Nurul Fikri Boarding School Serang' . $end;
    } elseif (strlen($content) < $length) {
        return $content . $end;
    }

    $pos = strpos($content, ' ', $length);
    $result = substr($content, 0, $pos);

    return $result . $end;
}

function human_filesize($bytes, $decimals = 2)
{
    $size = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
}

function fromCBT($no_psb)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://cbt.nfbs.or.id/index.php/api/user?no_psb=' . $no_psb,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return json_decode($response);
}
