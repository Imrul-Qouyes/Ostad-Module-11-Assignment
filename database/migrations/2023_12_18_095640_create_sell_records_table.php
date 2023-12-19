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
        Schema::create('sell_records', function (Blueprint $table) {
            $table->id();
            $table->string('product_name',200);
            $table->string('price',50);
            $table->string('quantity',50);
            $table->string('total',50);
            $table->date('sell_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sell_records');
    }
};
