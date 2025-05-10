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
    Schema::table('orders', function (Blueprint $table) {
        if (!Schema::hasColumn('orders', 'user_id')) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        }
        if (!Schema::hasColumn('orders', 'product_id')) {
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
        }
        if (!Schema::hasColumn('orders', 'quantity')) {
            $table->integer('quantity');
        }
        if (!Schema::hasColumn('orders', 'status')) {
            $table->string('status')->default('pending');
        }
    });
}

public function down(): void
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropForeign(['product_id']);
        $table->dropColumn(['user_id', 'product_id', 'quantity', 'status']);
    });
}
};
