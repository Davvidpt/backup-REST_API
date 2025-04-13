<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\MasterArea;
use Illuminate\Http\Request;
use Illuminate\Queue\RedisQueue;

class MasterAreaController extends Controller
{
    //
    public function index(){
        return response()->json([
            'data' => MasterArea::all()
        ]);
    }

    public function show($id){
        $area = MasterArea::find($id);
        if (!$area){
            return response()->json([
                'message' => 'data tidak ada'
            ],404);
        }
        return response()->json([
            'data' => $area
        ]);

    }
}
