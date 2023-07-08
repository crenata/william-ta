<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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
Route::get("email/verify", function () {
    return view("auth.verify-email");
})->middleware("auth")->name("verification.notice");
Route::get("email/verify/{id}/{hash}", function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route("home")->withStatus("Please verify email first!");
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::get('/email/verify', function () {
    return redirect()->route("home")->withStatus("Please verify email first!");
})->middleware('auth')->name('verification.notice');

Route::get("product-custom", [\App\Http\Controllers\HomeController::class, "custom"])->name("product.custom");
Route::get("products", [\App\Http\Controllers\User\ProductController::class, "index"])->name("products");
Route::get("products/{id}", [\App\Http\Controllers\User\ProductController::class, "index"])->name("products.category");
Route::get("offers", [\App\Http\Controllers\User\ProductController::class, "offer"])->name("offers");
Route::get("offers/{id}", [\App\Http\Controllers\User\ProductController::class, "offer"])->name("offers.category");
Route::get("product/{id}", [\App\Http\Controllers\User\ProductController::class, "show"])->name("product");

Route::middleware(["auth", "verified"])->group(function () {
    Route::get("account", [\App\Http\Controllers\User\AccountController::class, "index"])->name("account.index");
    Route::put("account", [\App\Http\Controllers\User\AccountController::class, "update"])->name("account.update");
    Route::post("buy", [\App\Http\Controllers\User\ProductController::class, "buy"])->name("buy");
    Route::resource("address", \App\Http\Controllers\User\AddressController::class);
    Route::resource("wishlist", \App\Http\Controllers\User\WishlistController::class);
    Route::resource("cart", \App\Http\Controllers\User\CartController::class);
    Route::resource("review", \App\Http\Controllers\User\ReviewController::class);
    Route::resource("custom-review", \App\Http\Controllers\User\CustomReviewController::class);
    Route::resource("refund", \App\Http\Controllers\User\RefundController::class);
    Route::resource("custom-refund", \App\Http\Controllers\User\CustomRefundController::class);
    Route::resource("transaction", \App\Http\Controllers\User\TransactionController::class)->names("transaction-user");
    Route::resource("custom", \App\Http\Controllers\User\CustomController::class)->names("custom-user");
});
Route::prefix("admin")->group(function () {
    Route::get("/", [\App\Http\Controllers\Auth\LoginController::class, "showLoginFormAdmin"])->name("admin.login");
    Route::post("/", [\App\Http\Controllers\Auth\LoginController::class, "loginAdmin"]);
    Route::middleware("auth:admin")->group(function () {
        Route::get("dashboard", [\App\Http\Controllers\Admin\DashboardController::class, "index"])->name("admin.home");
        Route::resource("admin", \App\Http\Controllers\Admin\AdminController::class);
        Route::resource("category", \App\Http\Controllers\Admin\CategoryController::class);
        Route::resource("product", \App\Http\Controllers\Admin\ProductController::class);
        Route::resource("transaction", \App\Http\Controllers\Admin\TransactionController::class);
        Route::resource("custom", \App\Http\Controllers\Admin\CustomController::class);
        Route::resource("province", \App\Http\Controllers\Admin\ProvinceController::class);
        Route::resource("city", \App\Http\Controllers\Admin\CityController::class);
        Route::resource("area", \App\Http\Controllers\Admin\AreaController::class);
    });
});
