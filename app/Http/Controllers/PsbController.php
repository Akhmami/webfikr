<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Events\PsbEvent;
use App\Models\Gelombang;
use App\Models\PostPsb;
use App\Models\User;

class PsbController extends Controller
{
    public function index()
    {
        $conf = Gelombang::query()
            ->whereNull('status')
            ->active()
            ->firstOrFail();

        $today = strtotime('today');
        $expiry = strtotime($conf->datetime_expired);
        $expired = false;

        if (is_null($conf->datetime_expired)) {
            return view('psb.comingsoon');
        }

        if ($today >= $expiry) {
            $expired = true;
        }

        return view('psb.index', [
            'expired' => $expired
        ]);
    }

    public function show($title)
    {
        $post = PostPsb::where('slug', $title)->first();
        if (!$post) {
            abort(404);
        }

        return view('psb.index', [
            'post' => $post
        ]);
    }

    public function internal()
    {
        $conf = Gelombang::query()
            ->where('status', 'I')
            ->active()
            ->firstOrFail();

        $today = strtotime('today');
        $expiry = strtotime($conf->datetime_expired);
        $expired = false;

        if (is_null($conf->datetime_expired)) {
            return view('psb.comingsoon');
        }

        if ($today >= $expiry) {
            $expired = true;
        }

        return view('psb.index', [
            'expired' => $expired
        ]);
    }

    public function mutasi()
    {
        $conf = Gelombang::query()
            ->where('status', 'M')
            ->active()
            ->firstOrFail();

        $today = strtotime('today');
        $expiry = strtotime($conf->datetime_expired);
        $expired = false;

        if (is_null($conf->datetime_expired)) {
            return view('psb.comingsoon');
        }

        if ($today >= $expiry) {
            $expired = true;
        }

        return view('psb.index', [
            'expired' => $expired
        ]);
    }

    public function verify($string)
    {
        try {
            $decrypted = Crypt::decrypt($string);
        } catch (DecryptException $e) {
            return view('psb.callback', [
                'data' => [
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]
            ]);
        }

        $today = strtotime('today');
        $expired = strtotime($decrypted['datetime_expired']);

        if ($today >= $expired) {
            return view('psb.callback', [
                'data' => [
                    'status' => 'error',
                    'message' => 'Link Expired.'
                ]
            ]);
        } else {
            $conf = Gelombang::findOrFail(1);
            $new_nopes = $conf->ta . $decrypted['no_unik'];
            $check = User::where('username', $new_nopes)->exists();
            if ($check) {
                $new_nopes += 1;
            }

            $user = User::with('student')->where('id', $decrypted['id'])->first();
            if ($user->students()->where('jenjang', 'SMA')->exists()) {
                return view('psb.callback', [
                    'data' => [
                        'status' => 'error',
                        'message' => 'Oops..., Link ini tidak bisa diproses ulang.'
                    ]
                ]);
            }

            $update = $user->update([
                'username' => $new_nopes,
                'password' => substr($user->no_hp, -6)
            ]);

            if ($update) {
                $data = collect($user->student)->except([
                    'id', 'grade_id', 'hostel_id', 'achievement_id', 'jurusan',
                    'status_du', 'status_penerimaan', 'status_santri',
                    'payment_option_id', 'size_kemeja', 'size_celana_atau_rok',
                    'keterangan_baju', 'created_at', 'updated_at', 'deleted_at'
                ]);

                $data['no_pendaftaran'] = $new_nopes;
                $data['jenjang'] = 'SMA';
                $data['angkatan'] = $conf->angkatan_sma;
                $data['jenis_pendaftaran'] = 'internal';
                $data['jurusan_pilihan'] = 'IPC';
                $data['asal_sekolah'] = 'SMP Islam Nurul Fikri Boarding School Serang';
                $data['npsn'] = '20605081';
                $data['alamat_asal_sekolah'] = 'Jl. Palka Kp. Cihideung ds. Bantarwaru';
                $data['hp_asal_sekolah'] = '087777833303';
                $data['jalur_masuk'] = 'psb';
                $data['gelombang'] = $conf->gelombang;
                $data['tahun_pendaftaran'] = $conf->ta;
                $data['status_psb'] = '1';
                $data['lokasi_test'] = 'Pesantren';
                $data['test_date_id'] = 1;
                $data['medical_check_id'] = 1;

                $new = $user->students()->create($data->toArray());
                $new->diskon = $decrypted['diskon'];
                $diskon = !empty($decrypted['diskon']->value) ? $decrypted['diskon']->value : 0;
                $new->billing = array(
                    'trx_id' => 'PSBSMA' . $new_nopes . mt_rand(100, 999),
                    'virtual_account' => '804101' . $conf->angkatan_sma . $new_nopes,
                    'total_tagihan' => $conf->biaya - $diskon,
                    'type' => 'psb',
                    'deskripsi' => 'invoice psb',
                    'datetime_expired' => $conf->datetime_expired
                );

                event(new PsbEvent($new));

                return view('psb.callback', [
                    'data' => [
                        'status' => 'success',
                        'message' => 'Silahkan cek kembali email anda.'
                    ]
                ]);
            } else {
                return view('psb.callback', [
                    'data' => [
                        'status' => 'error',
                        'message' => 'Gagal, Silahkan coba lagi. Jika terus berlanjut hubungi panitia.'
                    ]
                ]);
            }
        }
    }
}
