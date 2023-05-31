<?php

use Illuminate\Support\Facades\Auth;
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

Route::get("/", function () {
    return view("welcome");
});

Auth::routes();

Route::get("home", [\App\Http\Controllers\HomeController::class, "index"])->name("home");
Route::prefix("admin")->group(function () {
    Route::get("/", [\App\Http\Controllers\Auth\LoginController::class, "showLoginFormAdmin"])->name("admin.login");
    Route::post("/", [\App\Http\Controllers\Auth\LoginController::class, "loginAdmin"]);
    Route::middleware("auth:admin")->group(function () {
        Route::get("dashboard", function () {
            return view("admin.home");
        });
        Route::resource("admin", \App\Http\Controllers\AdminController::class);
    });
});
