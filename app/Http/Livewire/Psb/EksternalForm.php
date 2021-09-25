<?php

namespace App\Http\Livewire\Psb;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Events\Registered;
use App\Models\CountryCode;
use App\Models\Gelombang;
use App\Models\LokasiTest;
use App\Models\MedicalCheck;
use App\Models\Voucher;
use App\Models\User;
use App\Models\Year;

class EksternalForm extends Component
{
    public $nama_lengkap;
    public $nisn;
    public $gender;
    public $birth_date;
    public $birth_place;
    public $nik;
    public $jenjang;
    public $jurusan_pilihan;
    public $npsn;
    public $negara;
    public $provinsi;
    public $kabupaten;
    public $kecamatan;
    public $kelurahan;
    public $alamat;
    public $prov;
    public $kab;
    public $kec;
    public $kel;
    public $nama_ayah;
    public $tanggal_lahir_ayah;
    public $pendidikan_ayah;
    public $pekerjaan_ayah;
    public $tempat_kerja_ayah;
    public $country_code_ayah;
    public $no_wa_ayah;
    public $nama_ibu;
    public $tanggal_lahir_ibu;
    public $pendidikan_ibu;
    public $pekerjaan_ibu;
    public $tempat_kerja_ibu;
    public $country_code_ibu;
    public $no_wa_ibu;
    public $email;
    public $lokasi_test_id;
    public $medical_check_id;
    public $diskon;
    public $voucher;
    public $currentStep;
    public $maxStep;
    public $inputVoucher;
    public $list_jk;
    public $list_jenjang;
    public $list_jurusan;
    public $list_pendidikan;
    public $country_code;
    public $lokasi_test;
    public $medical_check;

    protected $stepRules = [
        1 => [
            'nama_lengkap' => 'required|min:3|max:200',
            'nisn' => 'required|numeric|min:10|max:10',
            'gender' => 'required',
            'birth_place' => 'required|min:3|max:100',
            'birth_date' => 'required|date_format:Y-m-d',
            'nik' => 'required|numeric|min:16|max:16',
            'jenjang' => 'required',
            'npsn' => 'required|numeric|min:6|max:8'
        ],
        2 => [
            'negara' => 'required|min:3|max:150',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'alamat' => 'required|min:10|max:250',
            'email' => 'required|email'
        ],
        3 => [
            'nama_ayah' => 'required',
            'tanggal_lahir_ayah' => 'required',
            'pendidikan_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'tempat_kerja_ayah' => 'required',
            'no_wa_ayah' => 'required|min:10|numeric',
            'nama_ibu' => 'required',
            'tanggal_lahir_ibu' => 'required',
            'pendidikan_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'tempat_kerja_ibu' => 'required',
            'no_wa_ibu' => 'required|min:10|numeric'
        ]
    ];

    public function mount()
    {
        $this->prov = DB::table('wilayah')
            ->whereRaw('CHAR_LENGTH(kode) = 2')
            ->pluck('nama', 'kode')
            ->toArray();

        $this->list_jk = ['L' => 'Laki-laki', 'P' => 'Perempuan'];
        $this->list_jenjang = ['SMP' => 'SMP Islam Nurul Fikri Serang', 'SMA' => 'SMA Islam Nurul Fikri Serang'];
        $this->list_jurusan = ['IPA' => 'IPA', 'IPS' => 'IPS', 'IPC' => 'IPA/IPS'];
        $this->list_pendidikan = ['SD' => 'SD', 'SMP' => 'SMP', 'SMA' => 'SMA', 'D3' => 'D3', 'S1' => 'S1', 'S2' =>
        'S2', 'S3' => 'S3'];
        $this->country_code = CountryCode::pluck('iso', 'phonecode')->toArray();
        $this->lokasi_test = LokasiTest::pluck('lokasi', 'id')->toArray();
        $this->medical_check = MedicalCheck::pluck('title', 'id')->toArray();
        $this->inputVoucher = false;
        $this->currentStep = 1;
        $this->maxStep = 1;
    }

    public function render()
    {
        if (!empty($this->provinsi)) {
            $this->kab = DB::table('wilayah')
                ->whereRaw('LEFT(kode, 2) = ' . $this->provinsi)
                ->whereRaw('CHAR_LENGTH(kode) = 5')
                ->orderBy('nama')
                ->pluck('nama', 'kode')->toArray();
        }

        if (!empty($this->kabupaten)) {
            $this->kec = DB::table('wilayah')
                ->whereRaw('LEFT(kode, 5) = ' . $this->kabupaten)
                ->whereRaw('CHAR_LENGTH(kode) = 8')
                ->orderBy('nama')
                ->pluck('nama', 'kode')->toArray();
        }

        if (!empty($this->kecamatan)) {
            $this->kel = DB::table('wilayah')
                ->where('kode', 'like', '%' . $this->kecamatan . '%')
                ->whereRaw('CHAR_LENGTH(kode) = 13')
                ->orderBy('nama')
                ->pluck('nama', 'kode')->toArray();
        }

        return view('livewire.psb.eksternal-form');
    }

    public function updated($field)
    {
        if ($field === 'voucher') {
            if (!empty($this->voucher)) {
                $voucher = Voucher::where('name', $this->voucher)->first();

                if ($voucher) {
                    $today = strtotime('today');
                    $expired = strtotime($voucher->datetime_expired);
                    if ($today >= $expired) {
                        $this->voucher = '';
                        session()->flash('vouchererr', 'Mohon maaf, masa berlaku voucher sudah habis klik daftar sekarang untuk melanjutkan!');
                    } else {
                        if ($voucher->available < 1) {
                            $this->voucher = '';
                            session()->flash('vouchererr', 'Mohon maaf, kuota voucher sudah habis klik daftar sekarang untuk melanjutkan!');
                        } else {
                            $this->diskon = $voucher;
                            session()->flash('vouchersuc', 'Alhamdulillah dapat diskon ' . $voucher->nominal . ' klik daftar sekarang untuk melanjutkan!');
                        }
                    }
                } else {
                    session()->flash('vouchererr', 'voucher tidak tersedia, klik daftar sekarang untuk melanjutkan!');
                }
            }
        }
    }

    public function hydrate()
    {
        $this->resetValidation();
    }

    public function store()
    {
        if (in_array($this->currentStep, array_keys($this->stepRules))) {
            if ($this->currentStep >= 3) {
                $validatedData = $this->validate(array_merge($this->stepRules[1], $this->stepRules[2], $this->stepRules[3]));
            } else {
                $validatedData = $this->validate($this->stepRules[$this->currentStep]);
            }
        }

        if ($this->currentStep >= 3) {
            $request = $this->handleRequest($validatedData);
            DB::beginTransaction();

            try {
                $user = $this->createUser($request);
                $user->mobilePhones()->createMany([
                    [
                        'name' => $request['nama_ayah'],
                        'country_code' => $request['country_code_ayah'],
                        'number' => $request['no_wa_ayah'],
                    ],
                    [
                        'name' => $request['nama_ibu'],
                        'country_code' => $request['country_code_ibu'],
                        'number' => $request['no_wa_ibu'],
                        'is_first' => 'Y'
                    ],
                ]);
                $user->userDetail()->create($request);
                $biller = $user->billers()->create($request);
                $request['user_id'] = $user->id;
                $biller->billings()->create($request);

                if ($this->diskon !== null) {
                    $user->vouchers()->attach($this->diskon->id);
                }

                DB::commit();
                Registered::dispatch($request);
                $this->dispatchBrowserEvent('swal:modal', [
                    'type' => 'success',
                    'title' => 'Terima Kasih',
                    'text' => 'Pendaftaran berhasil, silahkan cek email atau WA anda',
                ]);
                $this->reset();
            } catch (\Throwable $th) {
                DB::rollback();
                $this->emit('showFlash', 'error', 'Pendaftaran gagal, #' . $th->getMessage());
            }

            return;
        }

        $this->currentStep = $this->currentStep + 1;
        $this->maxStep = max($this->maxStep, $this->currentStep);
    }

    public function showVoucher()
    {
        $this->inputVoucher = true;
    }

    private function createUser($data)
    {
        $user = User::where('name', 'like', '%' . $data['nama_lengkap'] . '%')
            ->where('email', $data['email'])
            ->first();

        if ($user) {
            return false;
        }

        $user = User::create($data);
        $user->assignRole('user');
        return $user;
    }

    public function changeStep($step)
    {
        if ($this->maxStep < $step) {
            return;
        }

        $this->currentStep = $step;
    }

    private function handleRequest($data)
    {
        $gel = Gelombang::active()->first();
        $conf = Year::active()->first();

        if ($this->jenjang === 'SMP') {
            $angkatan = $conf->angkatan_smp;
            $nopes_array = [
                'L' => ($conf->periode . '1' . mt_rand(100, 999)),
                'P' => ($conf->periode . '2' . mt_rand(100, 999))
            ];

            $nopeserta = $nopes_array[$this->gender];
            $trx_id = 'PSBSMP' . $nopeserta;
        } else {
            $angkatan = $conf->angkatan_sma;
            $nopes_array = [
                'L' => ($conf->periode . '3' . mt_rand(100, 999)),
                'P' => ($conf->periode . '4' . mt_rand(100, 999))
            ];

            $nopeserta = $nopes_array[$this->gender];
            $trx_id = 'PSBSMA' . $nopeserta;
        }

        $data['name'] = $data['nama_lengkap'];
        $data['status_psb_id'] = 1;
        $data['gelombang_id'] = $gel->id;
        $data['username'] = $nopeserta;
        $data['no_pendaftaran'] = $nopeserta;
        $data['provinsi'] = $this->prov[$this->provinsi];
        $data['kota'] = $this->kab[$this->kabupaten];
        $data['kecamatan'] = $this->kec[$this->kecamatan];
        $data['kelurahan'] = $this->kel[$this->kelurahan];
        $data['password'] = bcrypt(date('dmY', strtotime($this->birth_date)));
        $data['jalur_masuk'] = 'psb';
        $data['angkatan'] = $angkatan;
        $data['jenis_pendaftaran'] = 'eksternal';
        $data['tahun_pendaftaran'] = $conf->periode;
        $data['biaya'] = $gel->biaya_pendaftaran;
        $data['datetime_expired'] = $gel->tgl_tes;
        $data['virtual_account'] = $nopeserta;
        $data['trx_id'] = $trx_id;
        $data['diskon'] = $this->diskon;
        $data['trx_amount'] = $gel->biaya_pendaftaran - ($this->diskon ? $this->diskon->value : 0);
        $data['amount'] = $gel->biaya_pendaftaran - ($this->diskon ? $this->diskon->value : 0);
        $data['type'] = 'PSB';
        $data['description'] = 'invoice psb';
        $data['customer_name'] = $this->nama_lengkap;
        $data['billing_type'] = 'c';
        $data['country_code_ayah'] = $this->country_code_ayah;
        $data['country_code_ibu'] = $this->country_code_ibu;

        return $data;
    }
}
