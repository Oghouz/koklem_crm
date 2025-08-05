<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MigrateInvoicePaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $invoices = DB::table('invoices')->get();

        foreach ($invoices as $invoice) {
            // Récupérer les commandes liées à cette facture
            $orders = DB::table('invoice_order')
                ->join('orders', 'invoice_order.order_id', '=', 'orders.id')
                ->where('invoice_order.invoice_id', $invoice->id)
                ->get(['orders.paid', 'orders.payment_date', 'orders.payment_method']);

            if ($orders->isEmpty()) {
                continue; // aucune commande liée à cette facture
            }

            $allPaid = $orders->every(fn($o) => $o->paid);
            $paymentDate = null;
            $paymentMethod = null;

            if ($allPaid) {
                $paymentDate = $orders->max('payment_date');
                $paymentMethod = $orders->pluck('payment_method')->filter()->first(); // ou faire une fréquence
            }

            DB::table('invoices')->where('id', $invoice->id)->update([
                'paid' => $allPaid ? 1 : 0,
                'paid_at' => $allPaid ? $paymentDate : null,
                'payment_method' => $allPaid ? $paymentMethod : null,
            ]);
        }
    }
}
