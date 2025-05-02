<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterCust;


class MasterCustController extends Controller
{
    //
    public function index(){
        return response()->json([
            MasterCust::take(10)->get()
        ]);
    }

    public function show($id){
        $cust= MasterCust::find($id);
        if (!$cust){
            return response()->json([
                'message' => 'data tidak ada'
            ],404);
        }
        return response()->json([
            $cust
        ]);

    }
}
