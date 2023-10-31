<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusPengajuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = [
            [
                'status' => 'Menunggu',
            ],
            [
                'status' => 'Diterima',
            ],
            [
                'status' => 'Ditolak',
            ],
        ];
        DB::table('status_pengajuans')->insert($status);
    }
}
