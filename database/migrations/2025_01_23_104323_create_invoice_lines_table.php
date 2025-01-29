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
        Schema::create('invoice_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('invoices')->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('set null');
            $table->foreignId('design_id')->nullable()->constrained('designs')->onDelete('set null');
            $table->text('product_reference');
            $table->text('product_name');
            $table->text('product_category')->nullable();
            $table->text('product_description')->nullable();
            $table->text('product_color')->nullable();
            $table->text('product_size')->nullable();
            $table->decimal('product_price', 10, 2)->default(0)->nullable();
            $table->decimal('product_tva', 10, 2)->default(0)->nullable();
            $table->integer('quantity')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_lines');
    }
};
