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
                'status' => 'Waiting for Approval',
            ],
            [
                'status' => 'Approved',
            ],
            [
                'status' => 'Rejected',
            ],
            [
                'status' => 'Rejected With Offer',
            ],
            [
                'status' => 'Offer Updated by Exporter',
            ]
        ];
        DB::table('status_pengajuans')->insert($status);
    }
}
