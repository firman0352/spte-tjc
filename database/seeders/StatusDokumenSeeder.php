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
                'status' => 'Menunggu Verifikasi',
            ],
            [
                'status' => 'Selesai',
            ],
            [
                'status' => 'Ditolak',
            ],
            [
                'status' => 'Perlu Perbaikan',
            ],
            [
                'status' => 'Dalam Proses Verifikasi',
            ],
            [
                'status' => 'Disetujui Inspektur 1',
            ],
            [
                'status' => 'Disetujui Inspektur 2',
            ]
        ];
        
        foreach ($status as $key => $value) {
            \App\Models\StatusDokumen::create($value);
        }
    }
}
