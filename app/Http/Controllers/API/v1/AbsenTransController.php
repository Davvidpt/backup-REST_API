<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AbsenTrans;

class AbsenTransController extends Controller
{
    //
    public function index(){
        return response()->json([
            'data' => AbsenTrans::oldest()
        ]);
    }
}
