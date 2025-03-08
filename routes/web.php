<?php

use App\Http\Controllers\LicensePlateController;
use Illuminate\Support\Facades\Route;


Route::get('/', [LicensePlateController::class, 'index'])->name('matricula.index');
Route::post('/matricula/procesar', [LicensePlateController::class, 'processImage'])->name('matricula.procesar');