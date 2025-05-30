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
        Schema::create('wosupplies', function (Blueprint $table) {
            $table->increments('wosuppliesid')->primary();
            $table->string('wosuppliesdesc');
            $table->integer('workorderid');
            $table->string('worfid');
            $table->string('particulars');
            $table->integer('qty');
            $table->string('remarks')->nullable();
            $table->integer('userid');
            $table->string('fullname');
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
        Schema::dropIfExists('wosupplies');
    }
};
