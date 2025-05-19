<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;

class workorder extends Model
{
    use HasFactory, Notifiable;

    protected $connection = 'mysql';
    protected $table = 'cmms.workorder';  
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
        'rdeptid',
        'rdeptname',
        'headid',
        'hfullname',
        'hdeptid',
        'hdeptname',
        'workclassid',
        'workclassdesc',
        'workorderdesc',
        'woimage',
        'email',
        'mobile_primary',
        'mobile_secondary',
        'homeno',
        'notedbyid',
        'nfullname',
        'ndeptid',
        'ndeptname',
        'verifybyid',
        'vfullname',
        'vdeptid',
        'vdeptname',
        'suppliesID',
        'schedule',
        'eworkdays',
        'dtstarted',
        'dtended',
        'startedbyid',
        'sfullname',
        'completedbyid',
        'cfullname',
        'monitoredbyid',
        'mfullname',
        'notes',
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
