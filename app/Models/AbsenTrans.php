<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsenTrans extends Model
{
    //
    public $table = 'absentrans';
    public $primaryKey = 'absentransid';
    public $fillable = [
        'absentransid',
        'absentransentryno',
        
    ];
}
