<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class schedule extends Model
{
    protected $connection = 'mysql';
    protected $table = 'cmms.schedules';  
    protected $primaryKey = 'schedid';

    protected $dates = [
        'timerecorded',
    ];
    public function gettimerecordedAttribute($dates) {
        return \Carbon\Carbon::parse($dates)->format('Y-m-d h:i:s A');
    }

    protected $fillable = [
        'workorderid',
        'worfid',
        'title',
        'start',
        'end',
        'description',
        'color',
    ];
            
}
