<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;

class modified extends Model
{
    use HasFactory, Notifiable;

    protected $connection = 'mysql';
    protected $table = 'cmms.modified';  
    protected $primaryKey = 'modifiedid';

    protected $dates = [
        'timerecorded',
    ];
    public function gettimerecordedAttribute($dates) {
        return \Carbon\Carbon::parse($dates)->format('Y-m-d h:i:s A');
    }

    protected $fillable = [
        'mid',
        'middesc',
        'midclass',
        'notes',
        'timerecorded',
        'created_by',
        'updated_by',
        'mod',
        'copied',
        'status',
    ];
        
}
