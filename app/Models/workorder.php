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
        'remail',
        'rdeptid',
        'rdeptname',
        'rsignimage',
        'headid',
        'hfullname',
        'hemail',
        'hdeptid',
        'hdeptname',
        'hsignimage',
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
        'vsignimage',
        'suppliesID',
        'title',
        'start',
        'end',
        'description',
        'color',
        'eworkdays',
        'dtstarted',
        'wosimage',
        'dtended',
        'woeimage',
        'startedbyid',
        'sfullname',
        'ssignimage',
        'semail',
        'completedbyid',
        'cfullname',
        'cemail',
        'csignimage',
        'monitoredbyid',
        'mfullname',
        'memail',
        'msignimage',
        'notes',
        'fsuserid',
        'fsfullname',
        'fsemail',
        'fsdeptid',
        'fseptname',
        'fstsigned',
        'fsstatus',
        'fssignimage',
        'fduserid',
        'fdfullname',
        'fdemail',
        'fddeptid',
        'fddeptname',
        'fddtsigned',
        'fdstatus',
        'fdsignimage',
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
