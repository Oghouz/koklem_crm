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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('num');
            $table->string('status');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->boolean('paid')->default(false);
            $table->string('payment_method')->nullable();
            $table->string('shipping_method')->nullable();
            $table->date('delivery_date')->nullable(); // Date de livraison
            $table->date('payment_date')->nullable();  // Date de paiement
            $table->decimal('total_ht', 10, 2)->nullable();
            $table->decimal('total_tva', 10, 2)->nullable();
            $table->decimal('total_ttc', 10, 2)->nullable();
            $table->integer('total_lines')->default(0);
            $table->text('comment')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();

            // Indexes
            $table->index('num');
            $table->index(['created_by', 'updated_by']);
            $table->index('delivery_date');
            $table->index('payment_date');

            // Foreign keys
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
