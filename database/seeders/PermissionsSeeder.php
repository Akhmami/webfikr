<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'lihat dashboard']);
        Permission::create(['name' => 'buat artikel']);
        Permission::create(['name' => 'edit artikel']);
        Permission::create(['name' => 'hapus artikel']);
        Permission::create(['name' => 'publish artikel']);
        Permission::create(['name' => 'unpublish artikel']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'writer']);
        $role1->givePermissionTo('edit artikel');
        $role1->givePermissionTo('buat artikel');

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('lihat dashboard');
        $role2->givePermissionTo('publish artikel');
        $role2->givePermissionTo('unpublish artikel');

        $role3 = Role::create(['name' => 'super-admin']);
        $role4 = Role::create(['name' => 'user']);

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('secret')
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'MD Akmami',
            'username' => 'akhmami',
            'email' => 'akhmami@gmail.com',
            'password' => bcrypt('Jatidiri93')
        ]);
        $user->assignRole($role3);

        // $user = \App\Models\User::factory()->create([
        //     'name' => 'Basic User',
        //     'username' => 'user',
        //     'email' => 'user@example.com',
        // ]);
        // $user->assignRole($role4);
        // $user->userDetail()->create([
        //     'no_pendaftaran' => '12345678',
        //     'jenjang' => 'SMA',
        //     'angkatan' => '18',
        //     'jurusan_pilihan' => 'IPA',
        //     'jurusan' => 'IPA',
        //     'jenis_pendaftaran' => 'eksternal',
        //     'asal_sekolah' => 'SMP Al Azhar',
        //     'jalur_masuk' => 'psb'
        // ]);

        // $biller = $user->billers()->create([
        //     'amount' => 7000000,
        //     'type' => 'SPP',
        //     'is_active' => 'Y',
        //     'qty_spp' => 2,
        //     'previous_spp_date' => '2021-05-01',
        //     'description' => 'Tagihan SPP hingga bulan Juli'
        // ]);
        // $user->billings()->create([
        //     'trx_id' => 'SPPSMP12345678',
        //     'biller_id' => $biller->id,
        //     'virtual_account' => '12345678',
        //     'trx_amount' => 3500000,
        //     'billing_type' => 'c',
        //     'description' => 'Pembayaran SPP',
        //     'datetime_expired' => date('Y-m-d H:i:s', strtotime('2 days'))
        // ]);
    }
}
