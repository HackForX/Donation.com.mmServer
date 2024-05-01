<?php

namespace Database\Seeders;

use App\Models\SubItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubItem::factory()->count(10)->create();
    }
}
