<?php

use App\Http\Controllers\LogController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PerjalananController;
use App\Models\Perjalanan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix("/v1")->group(function(){

    //Routing For Api Pengguna
    Route::prefix("pengguna")->group(function() {
        Route::get("/", [PenggunaController::class, "get_all_data_pengguna"])->name("pengguna.get");
        Route::get("/{nik}", [PenggunaController::class, "get_with_nik"])->name("pengguna.get.nik");
        Route::post("/register", [PenggunaController::class, "register_pengguna"])->name("pengguna.register");
        Route::post("/login", [PenggunaController::class, "login_pengguna"])->name("pengguna.login");
    });

    Route::prefix("perjalanan")->group(function() {
        // Route::get("/", [PerjalananController::class, "get_all_data_perjalanan"])->name("perjalanan.get");
        Route::get("/all", [PerjalananController::class, "get_all_perjalanan"])->name("perjalanan.get");
        Route::post("/", [PerjalananController::class, "get_data_perjalanan"])->name("perjalanan.get.with.nik");
        Route::post("/create", [PerjalananController::class, "create_data_perjalanan"])->name("perjalanan.create");
        Route::delete("/delete", [PerjalananController::class, "delete_data_perjalanan"])->name("perjalanan.delete");
        Route::put("/edit", [PerjalananController::class, "edit_data_perjalanan"])->name("perjalanan.edit");
        Route::post("/halaman", [PerjalananController::class, "get_jumlah_halaman"])->name("perjalanan.get.halaman");
    });

    Route::post("/log", [LogController::class, "get_log"])->name("log.get");
});


