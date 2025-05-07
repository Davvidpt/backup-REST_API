<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterArea extends Model
{
    //
    protected $table = 'dbo.masterarea';
    protected $primaryKey = 'areaid';
    public $timestamps = false;
    protected $fillable =[
        'areaid',
        'areacode',
        'city',
        'state',
        'country',
        'postalcode',
        'district',
        'subdistrict',
        'description',
        'blocked',
        'longitude1',
        'latitude1',
        'longitude2',
        'latitude2',
        'longitude3',
        'latitude3',
        'longitude4',
        'latitude4',
        'longitude5',
        'latitude5',
        'longitude6',
        'latitude6',
        'longitude7',
        'latitude7',
        'longitude8',
        'latitude8',
        'mapvector',
        'internalstatus',
        'parentareaid',
        'areatree',
        'freemasterid1',
        'freevalue1',
        'freevalue2',
        'freevalue3',
        'freevalue4',
        'freevalue5',
        'freevalue6',
        'freevalue7',
        'freedatetime1',
        'freedatetime2',
        'freedatetime3',
        'freedescription1',
        'freedescription2',
        'freedescription3',
        'freedescription4',
        'freedescription5',
        'freedescription6',
        'freedescription7',
        'createby',
        'createdate',
        'createat',
        'modifyby',
        'modifydate',
        'modifyat',
        'modifystatus',
        'syncflag',
        'synccomm',
        'syncby',
        'syncfrom',
        'syncdate'

    ];
}

