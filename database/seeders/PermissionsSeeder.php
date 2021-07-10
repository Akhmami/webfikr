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
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Example Writer User',
            'username' => 'writer',
            'email' => 'writer@example.com',
        ]);
        $user->assignRole($role1);
        $user->billings()->create([
            'trx_id' => 'TRXID12345',
            'amount' => 3500000,
            'billing_type' => 'c',
            'type' => 'spp',
            'datetime_expired' => date('c', strtotime('2 month')),
            'virtual_account' => '12345',
            'customer_email' => 'akhmami@gmail.com',
            'customer_phone' => '085156154439',
            'description' => 'testing'
        ]);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Admin User',
            'username' => 'admin',
            'email' => 'admin@example.com',
        ]);
        $user->assignRole($role2);
        $user->billings()->create([
            'trx_id' => 'TRXID11111',
            'amount' => 3500000,
            'billing_type' => 'c',
            'type' => 'spp',
            'datetime_expired' => date('c', strtotime('2 month')),
            'virtual_account' => '11111',
            'customer_email' => 'akhmami@gmail.com',
            'customer_phone' => '085156154439',
            'description' => 'testing'
        ]);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Super-Admin User',
            'username' => 'super-admin',
            'email' => 'superadmin@example.com',
        ]);
        $user->assignRole($role3);
        $user->billings()->create([
            'trx_id' => 'TRXID22222',
            'amount' => 3500000,
            'billing_type' => 'c',
            'type' => 'spp',
            'datetime_expired' => date('c', strtotime('2 month')),
            'virtual_account' => '22222',
            'customer_email' => 'akhmami@gmail.com',
            'customer_phone' => '085156154439',
            'description' => 'testing'
        ]);
    }
}
