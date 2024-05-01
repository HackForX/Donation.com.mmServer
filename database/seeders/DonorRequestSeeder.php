<?php

namespace Database\Seeders;


use App\Models\DonorRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DonorRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DonorRequest::factory()->count(10)->create(); 
    }
}
