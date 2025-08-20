<?php

use App\Modules\Antrian\Services\PrinterService;
use Illuminate\Support\Facades\Route;


Route::get('/landing', [\App\Modules\Antrian\Controllers\AntrianController::class, 'landing']);
Route::get('/antrian', [\App\Modules\Antrian\Controllers\AntrianController::class, 'antrian']);
Route::get('/serving-load', [\App\Modules\Antrian\Controllers\AntrianController::class, 'servingLoad']);
Route::get('/queue-display', [\App\Modules\Antrian\Controllers\AntrianController::class, 'queueDisplay'])->middleware('web');
Route::get('/working-opd', [\App\Modules\Antrian\Controllers\AntrianController::class, 'getOpd']);
Route::get('/get-posts', [\App\Modules\Antrian\Controllers\AntrianController::class, 'getPosts']);
Route::get('/get-statistics', [\App\Modules\Antrian\Controllers\AntrianController::class, 'getStatistics']);
Route::get('/berita', [\App\Modules\Antrian\Controllers\AntrianController::class, 'allPost']);
Route::get('/berita/{slug}', [\App\Modules\Antrian\Controllers\AntrianController::class, 'detailPost']);
Route::get('/take-queue/{organization_id}', [\App\Modules\Antrian\Controllers\AntrianController::class, 'take']);
Route::post('/reservation', [\App\Modules\Antrian\Controllers\AntrianController::class, 'reservation']);
Route::post('/boarding', [\App\Modules\Antrian\Controllers\AntrianController::class, 'boarding']);
Route::get('/load-queue/{type}', [\App\Modules\Antrian\Controllers\AntrianController::class, 'index'])->middleware('web');
Route::get('/skip-queue/{id}', [\App\Modules\Antrian\Controllers\AntrianController::class, 'skipQueue'])->middleware('web');
Route::get('/serve-queue/{id}', [\App\Modules\Antrian\Controllers\AntrianController::class, 'serveQueue'])->middleware('web');
Route::get('/done-queue/{id}', [\App\Modules\Antrian\Controllers\AntrianController::class, 'doneQueue'])->middleware('web');


Route::get('/test-print', function(){
    (new PrinterService)->printStruk([
            'tanggal' => date('Y-m-d H:i:s'),
            'nomor' => str_pad(1, 3, '0', STR_PAD_LEFT),
            'nama_opd' => 'Dinas Uji Coba'
        ]);
});