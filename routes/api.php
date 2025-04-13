<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\TokenAuth;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware([TokenAuth::class])->get('master-areas',[\App\Http\Controllers\API\v1\MasterAreaController::class,'index']); 

Route::get('master-areas/{id}',[\App\Http\Controllers\API\v1\MasterAreaController::class,'show']);

##debugging
Route::get('/cek-tabel', function () {
    $namaTabel = 'masterarea'; 

    $hasil = DB::select("
        SELECT TABLE_NAME 
        FROM INFORMATION_SCHEMA.TABLES 
        WHERE TABLE_TYPE = 'BASE TABLE' 
        AND LOWER(TABLE_NAME) = LOWER(?)
    ", [$namaTabel]);

    if (count($hasil) > 0) {
        echo "Tabel <strong>{$namaTabel}</strong> ditemukan ✅";
    } else {
        echo "Tabel <strong>{$namaTabel}</strong> TIDAK ditemukan ❌";
    }
});
