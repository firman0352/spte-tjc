<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'customer',
            'email' => 'customer@localhost',
            'password' => bcrypt('customer'),
            'role_id' => 1,
        ]);
        
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@localhost',
            'password' => bcrypt('admin'),
            'role_id' => 2,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'inspektur',
            'email' => 'inspektur@localhost',
            'password' => bcrypt('inspektur'),
            'role_id' => 3,
        ]);
    }
}
