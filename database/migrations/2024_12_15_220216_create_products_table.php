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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('name');
            $table->string('size');
            $table->mediumText('description')->nullable();
            $table->string('image')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('price_buy', 10, 2)->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('tva_id');
            $table->unsignedBigInteger('color_id');
            $table->integer('stock')->nullable();
            $table->boolean('published')->default(true);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();

            // Indexes
            $table->index('reference');
            $table->index(['created_by', 'updated_by']);

            // Foreign keys
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tva_id')->references('id')->on('tvas')->onDelete('set null'); 
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null'); 
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('set null'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
