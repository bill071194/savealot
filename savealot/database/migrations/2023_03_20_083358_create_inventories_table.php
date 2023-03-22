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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id('id');
            $table->string('prod_name')->unique();
            $table->string('prod_description')->nullable();
            $table->decimal('prod_purchase_price')->nullable();
            $table->decimal('prod_selling_price')->nullable();
            $table->string('prod_units')->nullable();
            $table->integer('prod_size')->nullable();
            $table->integer('prod_quantity')->nullable();
            $table->date('prod_exp_date')->nullable();
            $table->string('prod_picture')->nullable();
            $table->timestamps()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
