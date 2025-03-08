<?php

use App\Http\Controllers\LicensePlateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/license-plate', [LicensePlateController::class, 'index'])->name('license-plate.index');
Route::post('/license-plate/process', [LicensePlateController::class, 'processImage'])->name('license-plate.process');