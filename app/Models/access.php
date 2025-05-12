<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;

class access extends Model
{
    use HasFactory, Notifiable;

    protected $connection = 'mysql';
    protected $table = 'cmms.access';  
    protected $primaryKey = 'accessid';

    protected $dates = [
        'timerecorded',
    ];
    public function gettimerecordedAttribute($dates) {
        return \Carbon\Carbon::parse($dates)->format('Y-m-d h:i:s A');
    }

    protected $fillable = [
        'accessname',
        'deptid',
        'deptname',
        'notes',
        'modifiedid',
        'timerecorded',
        'created_by',
        'updated_by',
        'mod',
        'copied',
        'status',
    ];
    
}
