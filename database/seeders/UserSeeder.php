<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory()->count(10)->create();
  
           User::create([
            'name' => 'Admin',
            'email' => 'devteam.ionic@gmail.com', 
            'password' => Hash::make('password'), 
            'phone'=>'09783150476'
         ])->assignRole('admin');
    }
}
