<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class history_workorder extends Model
{
    protected $connection = 'mysql';
    protected $table = 'cmms.history_workorder';  
    protected $primaryKey = 'workorderid';

    protected $dates = [
        'timerecorded',
    ];
    public function gettimerecordedAttribute($dates) {
        return \Carbon\Carbon::parse($dates)->format('Y-m-d h:i:s A');
    }

    protected $fillable = [
        'requesterid',
        'rfullname',
        'remail',
        'rdeptid',
        'rdeptname',
        'headid',
        'hfullname',
        'hemail',
        'hdeptid',
        'hdeptname',
        'workclassid',
        'workclassdesc',
        'workorderdesc',
        'woimage',
        'mobile_primary',
        'mobile_secondary',
        'homeno',
        'verifybyid',
        'vfullname',
        'vemail',
        'vdeptid',
        'vdeptname',
        'suppliesID',
        'schedule',
        'eworkdays',
        'dtstarted',
        'wosimage',
        'dtended',
        'woeimage',
        'startedbyid',
        'sfullname',
        'semail',
        'completedbyid',
        'cfullname',
        'cemail',
        'monitoredbyid',
        'mfullname',
        'memail',
        'notes',
        'fsuserid',
        'fsfullname',
        'fsemail',
        'fsdeptid',
        'fseptname',
        'fstsigned',
        'fsstatus',
        'fduserid',
        'fdfullname',
        'fdemail',
        'fddeptid',
        'fddeptname',
        'fddtsigned',
        'fdstatus',
        'priorityid',
        'prioritydesc',
        'modifiedid',
        'timerecorded',
        'created_by',
        'updated_by',
        'mod',
        'copied',
        'status',
    ];
}
