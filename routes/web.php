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
Route::get("/", [\App\Http\Controllers\HomeController::class, "index"])->name("home");
Route::get("/home", function () {
    return redirect()->route("home");
});
Route::get("custom", [\App\Http\Controllers\HomeController::class, "custom"])->name("custom");

Route::get("faq", function () {
    return view("faq");
})->name("faq");

Route::get("about", function () {
    return view("about");
})->name("about");

Route::get("contact", function () {
    return view("contact");
})->name("contact");

Route::get("return-policy", function () {
    return view("return-policy");
})->name("return-policy");

Auth::routes();

Route::get("products", [\App\Http\Controllers\User\ProductController::class, "index"])->name("products");
Route::get("products/{id}", [\App\Http\Controllers\User\ProductController::class, "index"])->name("products.category");
Route::get("product/{id}", [\App\Http\Controllers\User\ProductController::class, "show"])->name("product");

Route::middleware("auth")->group(function () {
    Route::get("account", [\App\Http\Controllers\User\AccountController::class, "index"])->name("account.index");
    Route::put("account", [\App\Http\Controllers\User\AccountController::class, "update"])->name("account.update");
    Route::post("buy", [\App\Http\Controllers\User\AccountController::class, "update"])->name("buy");
    Route::resource("address", \App\Http\Controllers\User\AddressController::class);
    Route::resource("wishlist", \App\Http\Controllers\User\WishlistController::class);
    Route::resource("cart", \App\Http\Controllers\User\CartController::class);
});
Route::prefix("admin")->group(function () {
    Route::get("/", [\App\Http\Controllers\Auth\LoginController::class, "showLoginFormAdmin"])->name("admin.login");
    Route::post("/", [\App\Http\Controllers\Auth\LoginController::class, "loginAdmin"]);
    Route::middleware("auth:admin")->group(function () {
        Route::get("dashboard", function () {
            return view("admin.home");
        });
        Route::resource("admin", \App\Http\Controllers\Admin\AdminController::class);
        Route::resource("category", \App\Http\Controllers\Admin\CategoryController::class);
        Route::resource("product", \App\Http\Controllers\Admin\ProductController::class);
    });
});
