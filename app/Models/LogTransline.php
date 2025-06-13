<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogTransline extends Model
{
    public $table = "dbo.logtransline";
    public $timestamp = false;
    public $primarykey = "logtranslineid";
}
