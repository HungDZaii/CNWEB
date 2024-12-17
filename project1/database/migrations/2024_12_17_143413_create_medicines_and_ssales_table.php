<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand')->nullable();
            $table->string('dosage');
            $table->string('form');
            $table->decimal('price', 10, 2);
            $table->integer('stock');
            $table->timestamps();
        });

        Schema::create('sales', function (Blueprint $table) {
            $table->id('sale_id');
            $table->foreignId('medicine_id')->constrained('medicines')->onDelete('cascade');
            $table->integer('quantity');
            $table->dateTime('sale_date');
            $table->string('customer_phone', 10)->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('sales');
        Schema::dropIfExists('medicines');
    }
};
