<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // اسم المنتج (مثل بيرا، نوفا، العين)
            $table->text('description')->nullable(); // وصف اختياري
            $table->integer('quantity')->default(0); // الكمية المتوفرة
            $table->decimal('price', 8, 2)->default(0.00); // سعر المنتج
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};