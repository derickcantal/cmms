<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;

class department extends Model
{

    use HasFactory, Notifiable;

    protected $connection = 'mysql';
    protected $table = 'cmms.department';  
    protected $primaryKey = 'deptid';

    protected $dates = [
        'timerecorded',
    ];
    public function gettimerecordedAttribute($dates) {
        return \Carbon\Carbon::parse($dates)->format('Y-m-d h:i:s A');
    }

    protected $fillable = [
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
