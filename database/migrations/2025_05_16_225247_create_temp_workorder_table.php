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
        Schema::create('temp_workorder', function (Blueprint $table) {
            $table->increments('tworkorderid')->primary();
            $table->string('worfid')->nullable();
            $table->integer('requesterid');
            $table->string('rfullname');
            $table->integer('rdeptid');
            $table->string('rdeptname');
            $table->integer('headid')->nullable();
            $table->string('hfullname')->nullable();
            $table->integer('hdeptid')->nullable();
            $table->string('hdeptname')->nullable();
            $table->dateTime('hdtsigned')->nullable();
            $table->string('hstatus')->nullable();
            $table->string('workclassid');
            $table->string('workclassdesc');
            $table->string('workorderdesc');
            $table->string('woimage')->nullable();
            $table->string('email');
            $table->string('mobile_primary')->nullable();
            $table->string('mobile_secondary')->nullable();
            $table->string('homeno')->nullable();
            $table->integer('notedbyid')->nullable();
            $table->string('nfullname')->nullable();
            $table->integer('ndeptid')->nullable();
            $table->string('ndeptname')->nullable();
            $table->dateTime('ndtsigned')->nullable();
            $table->string('nstatus')->nullable();
            $table->integer('verifybyid')->nullable();
            $table->string('vfullname')->nullable();
            $table->integer('vdeptid')->nullable();
            $table->string('vdeptname')->nullable();
            $table->dateTime('vdtsigned')->nullable();
            $table->string('vstatus')->nullable();
            $table->integer('suppliesID')->nullable();
            $table->string('eworkdays')->nullable();
            $table->datetime('dtstarted')->nullable();
            $table->datetime('dtended')->nullable();
            $table->integer('startedbyid')->nullable();
            $table->string('sfullname')->nullable();
            $table->integer('completedbyid')->nullable();
            $table->string('cfullname')->nullable();
            $table->integer('monitoredbyid')->nullable();
            $table->string('mfullname')->nullable();
            $table->dateTime('mdtsigned')->nullable();
            $table->string('mstatus')->nullable();
            $table->integer('priorityid')->nullable();
            $table->string('prioritydesc')->nullable();
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
        Schema::dropIfExists('temp_workorder');
    }
};
