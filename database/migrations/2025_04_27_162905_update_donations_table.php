<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            // احذف الحقول القديمة لو موجودة
            if (Schema::hasColumn('donations', 'customer_id')) {
                $table->dropForeign(['customer_id']);
                $table->dropColumn('customer_id');
            }
            if (Schema::hasColumn('donations', 'quantity')) {
                $table->dropColumn('quantity');
            }
            if (Schema::hasColumn('donations', 'recipient')) {
                $table->dropColumn('recipient');
            }

            // أضف الحقول فقط لو مش موجودة
            if (!Schema::hasColumn('donations', 'user_id')) {
                $table->foreignId('user_id')->constrained()->onDelete('cascade')->after('id');
            }
            if (!Schema::hasColumn('donations', 'amount')) {
                $table->decimal('amount', 8, 2)->after('user_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            if (Schema::hasColumn('donations', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
            if (Schema::hasColumn('donations', 'amount')) {
                $table->dropColumn('amount');
            }
        });
    }
};