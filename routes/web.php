<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QRCodeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [QRCodeController::class, 'index'])->name('qrcode.index');
Route::post('/generate', [QRCodeController::class, 'generate'])->name('qrcode.generate');
