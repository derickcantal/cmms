<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use \Carbon\Carbon;

class temp_users extends Model
{
    use HasFactory, Notifiable;

    protected $connection = 'mysql';
    protected $table = 'cmms.temp_users';  
    protected $primaryKey = 'userid';

    protected $dates = [
        'timerecorded',
    ];
    public function gettimerecordedAttribute($dates) {
        return \Carbon\Carbon::parse($dates)->format('Y-m-d h:i:s A');
    }

    protected $fillable = [
        'avatar',
        'username',
        'firstname',
        'middlename',
        'lastname',
        'birthdate',
        'email',
        'mobile_primary',
        'mobile_secondary',
        'homeno',
        'accessid',
        'accessname',
        'deptid',
        'deptname',
        'password',
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
