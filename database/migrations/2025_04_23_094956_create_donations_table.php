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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ربط بالمستخدم
            $table->foreignId('order_id')->nullable()->constrained()->onDelete('set null'); // ربط بالطلب (اختياري)
            $table->integer('quantity'); // الكمية
            $table->string('recipient'); // الجهة المستلمة
            $table->string('status')->default('pending'); // الحالة
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};