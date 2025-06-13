<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderTrans extends Model
{
    //
    public $table = "dbo.ordertrans";
    public $timestamp = false;
    public $primarykey = 'ordertransid';
}
