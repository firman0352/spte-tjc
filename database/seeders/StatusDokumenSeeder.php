<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusDokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = [
            [
                'status' => 'Not Verified', // 1 = belum verif
            ],
            [
                'status' => 'Submitted for Verification', // 2 = menunggu verif (customer submit verif)
            ],
            [
                'status' => 'Verified', // 3 = disetujui
            ],
            [
                'status' => 'Rejected', // 4 = ditolak
            ],
            [
                'status' => 'Need Revision', // 5 = ditolak
            ],
            [
                'status' => 'In Verification Process', // 6 = dalam proses verif (disetujui admin)
            ],
            [
                'status' => 'Approved by 1st Inspector', // 7 = disetujui inspektur 1
            ],
        ];
        
        foreach ($status as $key => $value) {
            \App\Models\StatusDokumen::create($value);
        }
    }
}
