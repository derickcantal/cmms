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
             $table->increments('workorderid')->primary();
            $table->string('worfid')->nullable();
            $table->integer('requesterid');
            $table->string('rfullname');
            $table->integer('rdeptid');
            $table->string('rdeptname');
            $table->string('remail');
            $table->string('rsignimage')->nullable();
            $table->integer('headid')->nullable();
            $table->string('hfullname')->nullable();
            $table->string('hemail')->nullable();
            $table->integer('hdeptid')->nullable();
            $table->string('hdeptname')->nullable();
            $table->dateTime('hdtsigned')->nullable();
            $table->string('hdsignimage')->nullable();
            $table->string('hstatus')->nullable();
            $table->string('workclassid');
            $table->string('workclassdesc');
            $table->string('workorderdesc');
            $table->string('woimage')->nullable();
            $table->string('mobile_primary')->nullable();
            $table->string('mobile_secondary')->nullable();
            $table->string('homeno')->nullable();
            $table->integer('verifybyid')->nullable();
            $table->string('vfullname')->nullable();
            $table->string('vemail')->nullable();
            $table->integer('vdeptid')->nullable();
            $table->string('vdeptname')->nullable();
            $table->dateTime('vdtsigned')->nullable();
            $table->string('vsignimage')->nullable();
            $table->string('vstatus')->nullable();
            $table->integer('suppliesID')->nullable();
            $table->string('eworkdays')->nullable();
            $table->string('title')->nullable();
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->string('description')->nullable();
            $table->string('color')->nullable();
            $table->datetime('dtstarted')->nullable();
            $table->string('wosimage')->nullable();
            $table->datetime('dtended')->nullable();
            $table->string('woeimage')->nullable();
            $table->integer('startedbyid')->nullable();
            $table->string('sfullname')->nullable();
            $table->string('ssignimage')->nullable();
            $table->string('semail')->nullable();
            $table->integer('completedbyid')->nullable();
            $table->string('cfullname')->nullable();
            $table->string('cemail')->nullable();
            $table->string('csignimage')->nullable();
            $table->integer('monitoredbyid')->nullable();
            $table->string('mfullname')->nullable();
            $table->string('memail')->nullable();
            $table->dateTime('mdtsigned')->nullable();
            $table->string('mstatus')->nullable();
            $table->string('msignimage')->nullable();
            $table->integer('fsuserid')->nullable();
            $table->string('fsfullname')->nullable();
            $table->string('fsemail')->nullable();
            $table->integer('fsdeptid')->nullable();
            $table->string('fseptname')->nullable();
            $table->dateTime('fstsigned')->nullable();
            $table->string('fsstatus')->nullable();
            $table->string('fssignimage')->nullable();
            $table->integer('fduserid')->nullable();
            $table->string('fdfullname')->nullable();
            $table->string('fdemail')->nullable();
            $table->integer('fddeptid')->nullable();
            $table->string('fddeptname')->nullable();
            $table->dateTime('fddtsigned')->nullable();
            $table->string('fdstatus')->nullable();
            $table->string('fdsignimage')->nullable();
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
