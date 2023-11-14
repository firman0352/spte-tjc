<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusOrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'Contract Signed by Exporter',
            'Contract Signed by Importer',
            'First Term Payment Submitted',
            'First Term Payment Received with Invoice',
            'Product In Production',
            'Production Completed',
            'Second Term Payment Submitted',
            'Second Term Payment Received with Invoice',
            'Freight Documents Sent',
            'Third Term Payment Submitted',
            'Third Term Payment Received with Invoice',
            'Bill of Lading Sent',
            'Product Has Arrived',
            'Transaction Completed',
        ];

        foreach ($statuses as $status) {
            \App\Models\StatusOrders::create([
                'status' => $status,
            ]);
        }
    }
}