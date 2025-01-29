<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_num')->unique();
            $table->foreignId('order_id')->constrained('orders');
            $table->foreignId('client_id')->constrained('clients');
            $table->string('client_company')->nullable();
            $table->string('client_first_name')->nullable();
            $table->string('client_last_name')->nullable();
            $table->string('client_address1')->nullable();
            $table->string('client_address2')->nullable();
            $table->string('client_zip_code')->nullable();
            $table->string('client_city')->nullable();
            $table->string('client_siret')->nullable();
            $table->string('client_tva_number')->nullable();
            $table->string('client_email')->nullable();
            $table->string('client_phone')->nullable();
            $table->date('issue_date'); // Date d'émission
            $table->date('due_date'); // Date d'échéance
            $table->enum('status', ['paid', 'unpaid', 'pending'])->default('unpaid');
            $table->string('payment_method')->nullable();
            $table->decimal('total_ht', 10, 2);
            $table->decimal('total_tva', 10, 2);
            $table->decimal('total_ttc', 10, 2);
            $table->decimal('total_paid', 10, 2)->default(0);
            $table->boolean('accounted')->default(false);
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
