<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterCust extends Model
{
    //
    protected $table = 'dbo.mastercust';
    protected $primaryKey = 'custid';
    public $timestamps = false;
}
