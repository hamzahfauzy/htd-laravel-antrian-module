<?php

use App\Modules\Antrian\Services\Printer;
use Illuminate\Support\Facades\Route;


Route::get('/landing', function(){
    return view('antrian::landing');
});

Route::get('/working-opd', [\App\Modules\Antrian\Controllers\AntrianController::class, 'getOpd']);
Route::get('/take-queue/{organization_id}', [\App\Modules\Antrian\Controllers\AntrianController::class, 'take']);
Route::post('/reservation', [\App\Modules\Antrian\Controllers\AntrianController::class, 'reservation']);
Route::post('/boarding', [\App\Modules\Antrian\Controllers\AntrianController::class, 'boarding']);
Route::get('/test-print', function(){
    (new Printer)->printStruk([
            'tanggal' => date('Y-m-d H:i:s'),
            'nomor' => str_pad(1, 3, '0', STR_PAD_LEFT),
            'nama_opd' => 'Dinas Uji Coba'
        ]);
});