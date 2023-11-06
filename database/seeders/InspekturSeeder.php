<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InspekturSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usersData = [
            [
                'name' => 'Inspektur 1',
                'email' => 'inspektur1@localhost',
                'password' => bcrypt('inspektur'),
                'role_id' => 3,
            ],
            [
                'name' => 'Inspektur 2',
                'email' => 'inspektur2@localhost',
                'password' => bcrypt('inspektur'),
                'role_id' => 3,
            ],
        ];

        $userIds = [];

        foreach ($usersData as $userData) {
            $user = \App\Models\User::factory()->create($userData);
            $userIds[] = $user->id;
        }

        $inspektursData = [
            [
                'user_id' => $userIds[0], // Use the first user's ID
                'jabatan_id' => 1,
            ],
            [
                'user_id' => $userIds[1], // Use the second user's ID
                'jabatan_id' => 2,
            ],
        ];

        foreach ($inspektursData as $inspekturData) {
            \App\Models\Inspektur::create($inspekturData);
        }
    }
}
