<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;

class supplies extends Model
{
    use HasFactory, Notifiable;

    protected $connection = 'mysql';
    protected $table = 'cmms.supplies';  
    protected $primaryKey = 'suppliesid';

    protected $dates = [
        'timerecorded',
    ];
    public function gettimerecordedAttribute($dates) {
        return \Carbon\Carbon::parse($dates)->format('Y-m-d h:i:s A');
    }

    protected $fillable = [
        'suppliesdesc',
        'workorderid',
        'particulars',
        'qty',
        'remarks',
        'userid',
        'fullname',
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
