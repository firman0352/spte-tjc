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
        $users = [
            [
                'name' => 'customer',
                'email' => 'customer@localhost',
                'password' => bcrypt('customer'),
                'role_id' => 1,
            ],
            [
                'name' => 'admin',
                'email' => 'admin@localhost',
                'password' => bcrypt('admin'),
                'role_id' => 2,
            ],
        ];

        foreach ($users as $user) {
            \App\Models\User::factory()->create($user);
        }
    }
}
