<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Libraries\SheetDB;
use App\Models\User;

class OldStudent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:oldstudent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach ($this->generator() as $item) {
            // USE DB::TRANSACTIONS
            DB::beginTransaction();
            try {
                $student = DB::connection('mysql2')->table('students')->where('no_pendaftaran', $item->no_pendaftaran)->first();
                if ($student) {
                    // CREATE USER
                    $user = User::create([
                        'name' => $item->nama_lengkap,
                        'username' => $item->no_pendaftaran,
                        'email' => $item->no_pendaftaran . '@email.com',
                        'password' => bcrypt('123456'),
                        'gender' => $student->jenis_kelamin,
                        'birth_place' => $student->tempat_lahir,
                        'birth_date' => date('Y-m-d', strtotime($student->tanggal_lahir))
                    ]);

                    // GIVE ROLES
                    $user->assignRole('user');

                    $angkatan = ['8' => '22', '9' => '21', '11' => '19', '12' => '18'];

                    // CREATE USER DETAIL
                    $user->userDetail()->create([
                        'no_pendaftaran' => $student->no_pendaftaran,
                        'nis' => $student->nis ?? null,
                        'nik' => $student->nik ?? null,
                        'nisn' => $student->nisn ?? null,
                        'jenjang' => $student->jenjang ?? null,
                        'angkatan' => $angkatan[$item->kelas],
                        'jurusan_pilihan' => $student->jurusan_pilihan ?? null,
                        'jurusan' => $student->jurusan ?? null,
                        'jenis_pendaftaran' => null,
                        'asal_sekolah' => $student->asal_sekolah ?? null,
                        'npsn' => $student->npsn ?? null,
                        'alamat_asal_sekolah' => $student->alamat_asal_sekolah ?? null,
                        'hp_asal_sekolah' => $student->hp_asal_sekolah ?? null,
                        'alasan_pindah' => $student->alasan_pindah ?? null,
                        'negara' => 'Indonesia',
                        'anak_ke' => $student->anak_ke ?? null,
                        'jml_saudara' => $student->jumlah_saudara ?? null,
                        'alamat' => $student->alamat ?? null,
                        'provinsi' => $student->provinsi ?? null,
                        'kota' => $student->kabupaten ?? null,
                        'kecamatan' => $student->kecamatan ?? null,
                        'kelurahan' => $student->kelurahan ?? null,
                        'nama_ayah' => $student->nama_ayah ?? null,
                        'tanggal_lahir_ayah' => null,
                        'pendidikan_ayah' => $student->pendidikan_ayah ?? null,
                        'pekerjaan_ayah' => $student->pekerjaan_ayah ?? null,
                        'penghasilan_ayah' => $student->penghasilan_ayah ?? null,
                        'tempat_kerja_ayah' => $student->tempat_kerja_ayah ?? null,
                        'pendidikan_agama_ayah' => $student->pendidikan_agama_ayah ?? null,
                        'baca_quran_ayah' => null,
                        'haji_umroh_ayah' => null,
                        'organisasi_islam_ayah' => $student->organisasi_islam_ayah ?? null,
                        'buku_bacaan_islam_ayah' => $student->buku_bacaan_islam_ayah ?? null,
                        'nama_ibu' => $student->nama_ibu ?? null,
                        'tanggal_lahir_ibu' => null,
                        'pendidikan_ibu' => $student->pendidikan_ibu ?? null,
                        'pekerjaan_ibu' => $student->pekerjaan_ibu ?? null,
                        'penghasilan_ibu' => $student->penghasilan_ibu ?? null,
                        'tempat_kerja_ibu' => $student->tempat_kerja_ibu ?? null,
                        'pendidikan_agama_ibu' => $student->pendidikan_agama_ibu ?? null,
                        'baca_quran_ibu' => null,
                        'haji_umroh_ibu' => null,
                        'organisasi_islam_ibu' => $student->organisasi_islam_ibu ?? null,
                        'buku_bacaan_islam_ibu' => $student->buku_bacaan_islam_ibu ?? null,
                        'jalur_masuk' => $student->jalur_masuk ?? null,
                        'gelombang' => $student->gelombang ?? null,
                        'tahun_pendaftaran' => $student->tahun_pendaftaran ?? null,
                        'tahun_ajaran' => '2122',
                        'status' => 'santri'
                    ]);

                    // CREATE MOBILE PHONES
                    $user->mobilePhones()->createMany([
                        [
                            'name' => 'No HP Ayah',
                            'country_code' => '62',
                            'number' => $item->nomor_hp_ayah ?? 8,
                            'is_first' => 'Y'
                        ],
                        [
                            'name' => 'No HP Ibu',
                            'country_code' => '62',
                            'number' => $item->nomor_hp_ibu ?? 8,
                            'is_first' => 'Y'
                        ],

                    ]);

                    $grades = ['8' => 2, '9' => 3, '11' => 5, '12' => 6];

                    // GIVE GRADES
                    // $grade_id = $item->jenjang === 'SMP' ? 1 : 4;
                    $user->grades()->attach($grades[$item->kelas]);

                    // SET SPP
                    $user->setSpp()->create([
                        'nominal' => preg_replace('/\D/', '', ($item->komitmen_spp ?? 0))
                    ]);

                    $lunas = [
                        '1' => 'Juli', '2' => 'Agustus', '3' => 'September', '4' => 'Oktober',
                        '5' => 'November', '6' => 'Desember', '7' => 'Januari', '8' => 'Februari',
                        '9' => 'Maret', '10' => 'April', '11' => 'Mei', '12' => 'Juni'
                    ];
                    $spp_paid = [
                        '1' => '2021-07-01', '2' => '2021-08-01', '3' => '2021-09-01', '4' => '2021-10-01',
                        '5' => '2021-11-01', '6' => '2021-12-01', '7' => '2022-01-01', '8' => '2022-02-01',
                        '9' => '2022-03-01', '10' => '2022-04-01', '11' => '2022-05-01', '12' => '2022-06-01'
                    ];

                    // CREATE BILLER SPP AND SET PAID
                    if ($item->lunas_bulan > 0) {
                        for ($i = 1; $i <= $item->lunas_bulan; $i++) {
                            if ($i > 12) {
                                break;
                            }

                            $biller = $user->billers()->create([
                                'amount' => preg_replace('/\D/', '', $item->komitmen_spp ?? 0),
                                'cumulative_payment_amount' => preg_replace('/\D/', '', $item->komitmen_spp ?? 0),
                                'type' => 'SPP',
                                'is_installment' => 'N',
                                'is_active' => 'N',
                                'description' => 'Pembayaran SPP bulan ' . $lunas[$i]
                            ]);

                            $biller->billerDetails()->create([
                                'nama' => 'SPP bulan ' . $lunas[$i],
                                'nominal' => preg_replace('/\D/', '', $item->komitmen_spp ?? 0)
                            ]);
                            // Set VA Paid
                            $billing = $biller->billings()->create([
                                'user_id' => $user->id,
                                'trx_id' => 'SPP' . $student->jenjang . $item->no_pendaftaran . mt_rand(1000, 9999),
                                'customer_name' => $student->nama_lengkap,
                                'virtual_account' => $item->no_pendaftaran,
                                'trx_amount' => preg_replace('/\D/', '', $item->komitmen_spp ?? 0),
                                'billing_type' => 'c',
                                'is_paid' => 'Y',
                                'description' => 'Pembayaran SPP bulan ' . $lunas[$i],
                                'is_balance' => 'N',
                                'datetime_expired' => date('Y-m-d H:i:s', strtotime('yesterday')),
                                'spp_pay_month' => json_encode([$spp_paid[$i]])
                            ]);
                            // set payment history
                            $payment = $billing->paymentHistories()->create([
                                'payment_ntb' => $item->no_pendaftaran . mt_rand(1000, 9999),
                                'customer_name' => $item->nama_lengkap,
                                'virtual_account' => $item->no_pendaftaran,
                                'payment_amount' => preg_replace('/\D/', '', $item->komitmen_spp ?? 0),
                                'datetime_payment' => date('Y-m-d H:i:s')
                            ]);

                            // SPP PAID
                            $user->spps()->create([
                                'grade_id' => $grades[$item->kelas],
                                'payment_history_id' => $payment->id,
                                'bulan' => $spp_paid[$i]
                            ]);
                        }
                    }

                    if ($item->kelebihan > 0) {
                        $currentAmount_from_last = $user->balance->current_amount ?? 0;
                        $current_amount = $currentAmount_from_last + $item->kelebihan;
                        $user->balance()->create([
                            'last_amount' => $currentAmount_from_last,
                            'type' => 'plus',
                            'nominal' => $item->kelebihan,
                            'current_amount' => $current_amount,
                            'description' => 'Tambah saldo'
                        ]);
                    }
                }

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                $this->error('>>> Error: ' . $item->nama_lengkap);
                $this->error('Message: ' . $th->getMessage());
            }
        }
    }

    private function generator()
    {
        $sheets = SheetDB::get('https://sheetdb.io/api/v1/e1wz3g0j0p2mo');

        foreach ($sheets as $sheet) {
            yield $sheet;
        }
    }
}
