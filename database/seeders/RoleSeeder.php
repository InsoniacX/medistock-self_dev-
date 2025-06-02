<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Bersihkan cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Definisikan permission CRUD untuk setiap modul
        $modules = [
            'pengguna',
            'dashboard',
            'inventaris',
            'kadaluarsa',
            'pembelian',
            'penjualan',
            'kasir',
            'notifikasi',
            'pelaporan',
            'pengaturan',
            'filter',
            'detail obat'
        ];

        $permissions = [];

        foreach ($modules as $module) {
            $permissions[] = "create $module";
            $permissions[] = "read $module";
            $permissions[] = "update $module";
            $permissions[] = "delete $module";
        }

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Buat role
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $kasir = Role::firstOrCreate(['name' => 'kasir']);

        // Hak akses admin (semua)
        $admin->syncPermissions($permissions);

        // Hak akses kasir (Create & Read penjualan)
        $kasirPermissions = [
            'create penjualan',
            'read penjualan',
        ];

        $kasir->syncPermissions($kasirPermissions);
    }
}
