<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\TokenAuth;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::get('masteritems',[\App\Http\Controllers\API\v1\FxDtController::class, 'MasterItem']);
Route::get('masterrepresentatives',[\App\Http\Controllers\API\v1\FxDtController::class, 'MasterRepresentative']);
Route::get('pelunasans',[\App\Http\Controllers\API\v1\FxDtController::class, 'PelunasanPiutang']);
Route::get('custtranslines',[\App\Http\Controllers\API\v1\FxDtController::class, 'CustTransline']);
Route::get('logtrans',[\App\Http\Controllers\API\v1\FxDtController::class, 'LogTrans']);
Route::get('custtrans',[\App\Http\Controllers\API\v1\FxDtController::class, 'CustTrans']);
Route::get('masterareas',[\App\Http\Controllers\API\v1\FxDtController::class, 'MasterArea']);
Route::get('mastercusts',[\App\Http\Controllers\API\v1\FxDtController::class, 'MasterCust']);
// Route::middleware([TokenAuth::class])->get('masterareas',[\App\Http\Controllers\API\v1\MasterAreaController::class,'index']); 
// Route::middleware([TokenAuth::class])->get('mastercusts',[\App\Http\Controllers\API\v1\MasterCustController::class,'index']); 
// Route::get('masterarea/{id}',[\App\Http\Controllers\API\v1\MasterAreaController::class,'show']);
// #Route::get('mastercust/{id}',[\App\Http\Controllers\API\v1\MasterCustController::class,'show']);

##debugging
#Route::get('/cek-tabel', function () {
#    $namaTabel = 'masterarea'; 

#    $hasil = DB::select("
#        SELECT TABLE_NAME 
#        FROM INFORMATION_SCHEMA.TABLES 
#        WHERE TABLE_TYPE = 'BASE TABLE' 
#        AND LOWER(TABLE_NAME) = LOWER(?)
#    ", [$namaTabel]);

#    if (count($hasil) > 0) {
#        echo "Tabel <strong>{$namaTabel}</strong> ditemukan ✅";
#    } else {
#        echo "Tabel <strong>{$namaTabel}</strong> TIDAK ditemukan ❌";
#    }
#});