<?php

namespace App\Http\Livewire\Psb;

use Livewire\Component;
use App\Models\CountryCode;
use App\Models\Gelombang;
use App\Models\LokasiTest;
use App\Models\MedicalCheck;
use App\Models\Voucher;
use App\Models\User;
use App\Models\Year;
use App\Events\Registered;
use Illuminate\Support\Facades\DB;

class InternalForm extends Component
{
    public $user;
    public $nik;
    public $pilihan;
    public $birth_place;
    public $birth_date;
    public $list_pilihan;
    public $name;
    public $nisn;
    public $gender;
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
    public $nama_ibu;
    public $tanggal_lahir_ibu;
    public $pendidikan_ibu;
    public $pekerjaan_ibu;
    public $tempat_kerja_ibu;
    public $country_code_ibu;
    public $email;
    public $lokasi_test_id;
    public $medical_check_id;
    public $diskon;
    public $voucher;
    public $currentStep = 1;
    public $maxStep = 1;
    public $inputVoucher = false;
    public $list_jk;
    public $list_jenjang;
    public $list_jurusan;
    public $list_pendidikan;
    public $country_code;
    public $lokasi_test;
    public $medical_check;
    public $mobilePhones;

    protected $rules = [
        'name' => 'required|min:3|max:200',
        'nisn' => 'required|min:10|max:10',
        'gender' => 'required',
        'birth_place' => 'required|min:3|max:100',
        'birth_date' => 'required|date_format:Y-m-d',
        'nik' => 'required|min:16|max:16',
        'jurusan_pilihan' => 'required',
        'negara' => 'required|min:3|max:150',
        'provinsi' => 'required',
        'kabupaten' => 'required',
        'kecamatan' => 'required',
        'kelurahan' => 'required',
        'alamat' => 'required|min:10|max:250',
        'email' => 'required|email',
        'nama_ayah' => 'required',
        'tanggal_lahir_ayah' => 'required',
        'pendidikan_ayah' => 'required',
        'pekerjaan_ayah' => 'required',
        'tempat_kerja_ayah' => 'required',
        'nama_ibu' => 'required',
        'tanggal_lahir_ibu' => 'required',
        'pendidikan_ibu' => 'required',
        'pekerjaan_ibu' => 'required',
        'tempat_kerja_ibu' => 'required',
    ];

    public function mount()
    {
        $this->list_pilihan = ['nik' => 'Nomor Induk Kependudukan', 'ttl' => 'Tanggal Lahir'];
        $this->prov = DB::table('wilayah')
            ->whereRaw('CHAR_LENGTH(kode) = 2')
            ->pluck('nama', 'kode')
            ->toArray();

        $this->list_jk = ['L' => 'Laki-laki', 'P' => 'Perempuan'];
        $this->list_jenjang = ['SMP' => 'SMP Islam Nurul Fikri Serang', 'SMA' => 'SMA Islam Nurul Fikri Serang'];
        $this->list_jurusan = ['IPA' => 'IPA', 'IPS' => 'IPS', 'IPC' => 'IPA/IPS'];
        $this->list_pendidikan = ['SD' => 'SD', 'SMP' => 'SMP', 'SMA' => 'SMA', 'D3' => 'D3', 'S1' => 'S1', 'S2' =>
        'S2', 'S3' => 'S3'];
        $this->country_code = CountryCode::pluck('iso', 'phonecode');
        $this->lokasi_test = LokasiTest::pluck('lokasi', 'id');
        $this->medical_check = MedicalCheck::pluck('title', 'id');
    }

    public function render()
    {
        if (!empty($this->provinsi)) {
            $this->kab = DB::table('wilayah')
                ->whereRaw('LEFT(kode, 2) = ' . $this->provinsi)
                ->whereRaw('CHAR_LENGTH(kode) = 5')
                ->orderBy('nama')
                ->pluck('nama', 'kode');
        }

        if (!empty($this->kabupaten)) {
            $this->kec = DB::table('wilayah')
                ->whereRaw('LEFT(kode, 5) = ' . $this->kabupaten)
                ->whereRaw('CHAR_LENGTH(kode) = 8')
                ->orderBy('nama')
                ->pluck('nama', 'kode');
        }

        if (!empty($this->kecamatan)) {
            $this->kel = DB::table('wilayah')
                ->where('kode', 'like', '%' . $this->kecamatan . '%')
                ->whereRaw('CHAR_LENGTH(kode) = 13')
                ->orderBy('nama')
                ->pluck('nama', 'kode');
        }

        return view('livewire.psb.internal-form');
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

    public function showVoucher()
    {
        $this->inputVoucher = true;
    }

    public function check()
    {
        $this->validate([
            'pilihan' => 'required'
        ]);

        switch ($this->pilihan) {
            case 'nik':
                $this->user = User::with('mobilePhones')->whereHas('userDetail', function ($query) {
                    $query->where('nik', $this->nik)
                        ->where('jenjang', 'SMP')->latest('id');
                })->first();
                break;

            default:
                $this->user = User::with(['userDetail', 'mobilePhones'])->where('birth_place', $this->birth_place)
                    ->where('birth_date', $this->birth_date)
                    ->where('jenjang', 'SMP')->latest('id')->first();
                break;
        }

        if (!empty($this->user)) {
            $this->name = $this->user->name;
            $this->nik = $this->user->userDetail->nik;
            $this->nisn = $this->user->userDetail->nisn;
            $this->gender = $this->user->gender;
            $this->birth_place = $this->user->birth_place;
            $this->birth_date = $this->user->birth_date;
            $this->nama_ayah = $this->user->userDetail->nama_ayah;
            $this->tanggal_lahir_ayah = $this->user->userDetail->tanggal_lahir_ayah;
            $this->pendidikan_ayah = $this->user->userDetail->pendidikan_ayah;
            $this->pekerjaan_ayah = $this->user->userDetail->pekerjaan_ayah;
            $this->tempat_kerja_ayah = $this->user->userDetail->tempat_kerja_ayah;
            $this->nama_ibu = $this->user->userDetail->nama_ibu;
            $this->tanggal_lahir_ibu = $this->user->userDetail->tanggal_lahir_ibu;
            $this->pendidikan_ibu = $this->user->userDetail->pendidikan_ibu;
            $this->pekerjaan_ibu = $this->user->userDetail->pekerjaan_ibu;
            $this->tempat_kerja_ibu = $this->user->userDetail->tempat_kerja_ibu;
            $this->negara = $this->user->userDetail->negara;
            $this->provinsi = $this->user->userDetail->provinsi;
            $this->email = $this->user->email;
            $this->mobilePhones = $this->user->mobilePhones->toArray();
        } else {
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'title' => 'Oops...!',
                'text' => 'Mohon maaf, data yang diminta tidak ditemukan',
            ]);
        }
    }

    public function store()
    {
        $validatedData = $this->validate();
        $request = $this->handleRequest($validatedData);

        DB::beginTransaction();
        try {
            $user = $this->createUser($request);
            $user->mobilePhones()->createMany($this->mobilePhones);
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
            // dd('error ' . $th->getMessage());
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'title' => 'Oops...!',
                'text' => 'Pendaftaran gagal, silahkan coba lagi jika terus berlanjut hubungi kami. #' . $th->getMessage(),
            ]);
        }
    }

    private function createUser($data)
    {
        $user = User::where('name', 'like', '%' . $data['name'] . '%')
            ->where('email', $data['email'])
            ->whereHas('userDetail', function ($query) {
                $query->where('jenjang', 'SMA');
            })
            ->first();

        if ($user) {
            return false;
        }

        $user = User::create($data);
        $user->assignRole('user');
        return $user;
    }

    private function handleRequest($data)
    {
        $gel = Gelombang::active()->first();
        $conf = Year::active()->first();

        $angkatan = $conf->angkatan_sma;
        $nopes_array = [
            'L' => ($conf->periode . '5' . mt_rand(100, 999)),
            'P' => ($conf->periode . '6' . mt_rand(100, 999))
        ];
        $nopeserta = $nopes_array[$this->gender];
        $trx_id = 'PSBSMA' . $nopeserta;

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
        $data['jenjang'] = 'SMA';
        $data['npsn'] = '20605081';
        $data['asal_sekolah'] = 'SMP Islam Nurul Fikri Serang';
        $data['angkatan'] = $angkatan;
        $data['jenis_pendaftaran'] = 'internal';
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
        $data['customer_name'] = $this->name;
        $data['billing_type'] = 'c';

        return $data;
    }
}
