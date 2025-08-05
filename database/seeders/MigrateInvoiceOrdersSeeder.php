<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MigrateInvoiceOrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = DB::table('orders')
            ->whereNotNull('invoice_id')
            ->get(['id', 'invoice_id']);

        foreach ($orders as $order) {
            DB::table('invoice_order')->insertOrIgnore([
                'invoice_id' => $order->invoice_id,
                'order_id' => $order->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
