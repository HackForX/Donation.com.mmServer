<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Sadudithar;
use App\Models\SubCategory;
use App\Models\SubItem;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            PermissionSeeder::class,
            // ItemSeeder::class,
            // CitySeeder::class,
            // SubItemSeeder::class,
            // TownshipSeeder::class,
            // CategorySeeder::class,
            // SubCategorySeeder::class,
            // DonorRequestSeeder::class,
            // SaduditharSeeder::class,
            ContactSeeder::class
        ]);
    }
}
