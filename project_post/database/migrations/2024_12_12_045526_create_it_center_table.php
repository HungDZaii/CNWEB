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
        Schema::create('it_center', function (Blueprint $table) {
            $table->id(); // Mã trung tâm
            $table->string('name', 255); // Tên trung tâm
            $table->string('location', 255); // Địa điểm
            $table->string('contact_email', 255)->unique(); // Email liên hệ
            $table->timestamps(); // Thêm cột created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('it_center');
    }
};
