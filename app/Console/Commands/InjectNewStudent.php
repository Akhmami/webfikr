<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Libraries\SheetDB;
use App\Models\User;
use App\Models\Grade;

class InjectNewStudent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:newstudent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inject new student from spreadsheet';

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
                // CREATE USER
                $user = User::create([
                    'name' => $item->nama_lengkap,
                    'username' => $item->no_psb,
                    'email' => !empty($item->email) ? $item->email : $item->no_psb.'@email.com',
                    'password' => bcrypt(date('dmY', strtotime( !empty($item->tanggal_lahir) ? $item->tanggal_lahir : '21-12-2021' ))),
                    'gender' => $item->jk,
                    'birth_place' => $item->tempat_lahir,
                    'birth_date' => date('Y-m-d', strtotime($item->tanggal_lahir))
                ]);

                // GIVE ROLES
                $user->assignRole('user');

                // CREATE USER DETAIL
                $user->userDetail()->create([
                    'no_pendaftaran' => $item->no_psb,
                    'nik' => $item->nik ?? null,
                    'nisn' => $item->nisn ?? null,
                    'jenjang' => $item->jenjang,
                    'angkatan' => $item->jenjang === 'SMP' ? '22' : '20',
                    'asal_sekolah' => $item->asal_sekolah ?? null,
                    'npsn' => $item->npsn ?? null,
                    'negara' => 'Indonesia',
                    'tahun_pendaftaran' => '2122',
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
                    'datetime_expired' => date('Y-m-d H:i:s', strtotime('2 month'))
                ]);

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
