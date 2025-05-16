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
        Schema::create('supplies_delivery', function (Blueprint $table) {
            $table->increments('sdeliveryid')->primary();
            $table->integer('suppliesid');
            $table->string('suppliesdesc');
            $table->string('particulars')->nullable();
            $table->integer('qty');
            $table->integer('stocks');
            $table->integer('total');
            $table->decimal('price', $precision = 8, $scale = 2);
            $table->decimal('srp', $precision = 8, $scale = 2);
            $table->timestamps();
            $table->string('notes')->nullable();
            $table->integer('modifiedid');
            $table->dateTime('timerecorded');
            $table->string('created_by');
            $table->string('updated_by');
            $table->integer('mod');
            $table->string('copied')->nullable();
            $table->string('status'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplies_delivery');
    }
};
