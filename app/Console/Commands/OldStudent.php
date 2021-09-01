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
                        'email' => $student->no_psb . '@email.com',
                        'password' => bcrypt('123456'),
                        'gender' => $student->jenis_kelamin,
                        'birth_place' => $student->tempat_lahir,
                        'birth_date' => date('Y-m-d', strtotime($student->tanggal_lahir))
                    ]);

                    // GIVE ROLES
                    $user->assignRole('user');

                    // CREATE USER DETAIL
                    $user->userDetail()->create([
                        'no_pendaftaran' => $student->no_pendaftaran,
                        'nis' => $student->nis,
                        'nik' => $student->nik ?? null,
                        'nisn' => $student->nisn ?? null,
                        'jenjang' => $student->jenjang,
                        'angkatan' => $student->angkatan,
                        'jurusan_pilihan' => $student->jurusan_pilihan,
                        'jurusan' => $student->jurusan,
                        'jenis_pendaftaran' => $student->jenis_pendaftaran,
                        'asal_sekolah' => $student->asal_sekolah ?? null,
                        'npsn' => $student->npsn ?? null,
                        'alamat_asal_sekolah' => $student->alamat_asal_sekolah,
                        'hp_asal_sekolah' => $student->hp_asal_sekolah,
                        'alasan_pindah' => $student->alasan_pindah,
                        'negara' => 'Indonesia',
                        'anak_ke' => $student->anak_ke,
                        'jml_saudara' => $student->jumlah_saudara,
                        'alamat' => $student->alamat,
                        'provinsi' => $student->provinsi,
                        'kota' => $student->kota,
                        'kecamatan' => $student->kecamatan,
                        'kelurahan' => $student->kelurahan,
                        'nama_ayah' => $student->nama_ayah,
                        'tanggal_lahir_ayah' => null,
                        'pendidikan_ayah' => $student->pendidikan_ayah,
                        'pekerjaan_ayah' => $student->pekerjaan_ayah,
                        'penghasilan_ayah' => $student->penghasilan_ayah,
                        'tempat_kerja_ayah' => $student->tempat_kerja_ayah,
                        'pendidikan_agama_ayah' => $student->pendidikan_agama_ayah,
                        'baca_quran_ayah' => $student->baca_quran_ayah,
                        'haji_umroh_ayah' => $student->haji_umroh_ayah,
                        'organisasi_islam_ayah' => $student->organisasi_islam_ayah,
                        'buku_bacaan_islam_ayah' => $student->buku_bacaan_islam_ayah,
                        'nama_ibu' => $student->nama_ibu,
                        'tanggal_lahir_ibu' => null,
                        'pendidikan_ibu' => $student->pendidikan_ibu,
                        'pekerjaan_ibu' => $student->pekerjaan_ibu,
                        'penghasilan_ibu' => $student->penghasilan_ibu,
                        'tempat_kerja_ibu' => $student->tempat_kerja_ibu,
                        'pendidikan_agama_ibu' => $student->pendidikan_agama_ibu,
                        'baca_quran_ibu' => $student->baca_quran_ibu,
                        'haji_umroh_ibu' => $student->haji_umroh_ibu,
                        'organisasi_islam_ibu' => $student->organisasi_islam_ibu,
                        'buku_bacaan_islam_ibu' => $student->buku_bacaan_islam_ibu,
                        'jalur_masuk' => $student->jalur_masuk,
                        'gelombang' => $student->gelombang,
                        'tahun_pendaftaran' => $student->tahun_pendaftaran,
                        'tahun_ajaran' => '2122',
                        'status' => 'santri'
                    ]);

                    // CREATE MOBILE PHONES
                    $user->mobilePhones()->createMany([
                        [
                            'name' => 'No HP Ayah',
                            'country_code' => '62',
                            'number' => $item->nomor_hp_ayah,
                            'is_first' => 'N'
                        ],
                        [
                            'name' => 'No HP Ibu',
                            'country_code' => '62',
                            'number' => $item->nomor_hp_ibu,
                            'is_first' => 'Y'
                        ],

                    ]);

                    // GIVE GRADES
                    $grade_id = $item->jenjang === 'SMP' ? 1 : 4;
                    $user->grades()->attach($grade_id);

                    // SET SPP
                    $user->setSpp()->create([
                        'nominal' => preg_replace('/\D/', '', $item->komitmen_spp ?? 0)
                    ]);

                    // CREATE BILLER SPP JULY AND SET PAID
                    $biller = $user->billers()->create([
                        'amount' => preg_replace('/\D/', '', $item->komitmen_spp ?? 0),
                        'cumulative_payment_amount' => preg_replace('/\D/', '', $item->komitmen_spp ?? 0),
                        'type' => 'SPP',
                        'is_installment' => 'N',
                        'is_active' => 'N',
                        'description' => 'Pembayaran SPP bulan Juli'
                    ]);

                    $biller->billerDetails()->create([
                        'nama' => 'SPP bulan Juli',
                        'nominal' => preg_replace('/\D/', '', $item->komitmen_spp ?? 0)
                    ]);

                    $billing = $biller->billings()->create([
                        'user_id' => $user->id,
                        'trx_id' => $item->no_psb,
                        'virtual_account' => str_replace('80410', '80480', $item->va),
                        'trx_amount' => preg_replace('/\D/', '', $item->komitmen_spp ?? 0),
                        'billing_type' => 'c',
                        'is_paid' => 'Y',
                        'description' => 'SPP Pertama terbayar DUPSB',
                        'is_balance' => 'N',
                        'datetime_expired' => date('Y-m-d H:i:s', strtotime('1 month'))
                    ]);

                    $payment = $billing->paymentHistories()->create([
                        'payment_ntb' => $item->no_psb,
                        'customer_name' => $item->nama_lengkap,
                        'payment_amount' => preg_replace('/\D/', '', $item->komitmen_spp ?? 0),
                        'datetime_payment' => date('Y-m-d H:i:s')
                    ]);

                    // SPP PAID
                    $user->spps()->create([
                        'grade_id' => $grade_id,
                        'payment_history_id' => $payment->id,
                        'bulan' => '2021-07-01'
                    ]);

                    // CREATE BILLER SPP AUGUST
                    $biller2 = $user->billers()->create([
                        'amount' => preg_replace('/\D/', '', $item->komitmen_spp ?? 0),
                        'type' => 'SPP',
                        'is_installment' => 'N',
                        'is_active' => 'Y',
                        'previous_spp_date' => '2021-07-01',
                        'description' => 'Pembayaran SPP bulan Agustus'
                    ]);

                    $biller2->billerDetails()->create([
                        'nama' => 'SPP bulan Agustus',
                        'nominal' => preg_replace('/\D/', '', $item->komitmen_spp ?? 0)
                    ]);

                    $biller2->billings()->create([
                        'user_id' => $user->id,
                        'trx_id' => $item->trx_id,
                        'virtual_account' => $item->va,
                        'trx_amount' => preg_replace('/\D/', '', $item->komitmen_spp ?? 0),
                        'billing_type' => 'i',
                        'is_paid' => 'N',
                        'description' => 'Tagihan SPP Agustus',
                        'is_balance' => 'N',
                        'datetime_expired' => date('Y-m-d H:i:s', strtotime('2 month')),
                        'spp_pay_month' => json_encode(['2021-08-01'])
                    ]);
                }

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                $this->error('Error: ' . $item->nama_lengkap);
                $this->error($th->getMessage());
            }
        }
    }

    private function generator()
    {
        $sheets = SheetDB::get('https://sheetdb.io/api/v1/fyzf4o9bqagw8');

        foreach ($sheets as $sheet) {
            yield $sheet;
        }
    }
}
