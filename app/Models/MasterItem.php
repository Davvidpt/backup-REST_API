<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterItem extends Model
{
    //
    public $table = "dbo.masteritem";
    public $primaryKey = "itemid";
    public $timestamps = false;
}
