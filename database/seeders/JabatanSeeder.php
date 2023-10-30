<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jabatan = [
            [
                'jabatan' => 'Inspektur 1',
            ],
            [
                'jabatan' => 'Inspektur 2',
            ],
        ];
        foreach ($jabatan as $jabatan) {
            \App\Models\Jabatan::create($jabatan);
        }
    }
}
