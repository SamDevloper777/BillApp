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
            $table->string('name');
            $table->string('sku')->unique();
            $table->foreignId('category');
            $table->foreignId('metal_type'); // Gold, Silver
            $table->string('purity'); // 22K, 18K, 925
            $table->float('net_weight');
            $table->float('gross_weight')->nullable();
            $table->float('wastage_percent')->nullable();
            $table->float('making_charge')->nullable();
            $table->float('stone_weight')->nullable();
            $table->string('stone_type')->nullable();
            $table->float('purchase_price');
            $table->float('sale_price');
            $table->integer('stock_qty')->default(0);
            $table->string('image_path')->nullable();
            $table->timestamps();
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
