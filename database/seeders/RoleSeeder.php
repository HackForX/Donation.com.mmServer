<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        Role::create(['name' => 'admin', 'guard_name' => 'api']);
        Role::create(['name' => 'user', 'guard_name' => 'api']);
        Role::create(['name' => 'donor', 'guard_name' => 'api']);

    }
}
