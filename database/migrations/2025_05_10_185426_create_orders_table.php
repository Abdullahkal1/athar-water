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
        // Schema::create('orders', function (Blueprint $table) { ... }); // علّق الكود ده
    }
    
    public function down(): void
    {
        // Schema::dropIfExists('orders'); // علّق الكود ده
    }
};
