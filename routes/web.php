<?php

use App\Http\Controllers\PerjalananController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pencatatan-perjalanan', [PerjalananController::class, "main_entry"])->name("main");
Route::post("/export", [PerjalananController::class, "export_perjalnan"])->name("perjalanan.export");
