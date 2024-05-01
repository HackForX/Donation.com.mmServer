<?php

namespace Database\Seeders;

use App\Models\Sadudithar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaduditharSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sadudithar::factory()->count(10)->create();
    }
}
