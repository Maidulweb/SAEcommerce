<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\FrontendProductController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserAddressController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/flash-sale', [FlashSaleController::class, 'index'])->name('pages.flash-sale.index');
Route::get('/product-details/{slug}', [FrontendProductController::class, 'index'])->name('frontend.product-details.index');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');

require __DIR__.'/auth.php';

/* Cart */
Route::post('/shopping-cart', [CartController::class, 'addToCart'])->name('shopping-cart');
Route::get('/cart-details', [CartController::class, 'cartDetails'])->name('cart-details');
Route::post('/cart-quantity-update', [CartController::class, 'cartQuantityUpdate'])->name('cart-quantity-update');
Route::get('/cart-clear', [CartController::class, 'cartClear'])->name('cart.clear');
Route::get('/cart-remove/{rowId}', [CartController::class, 'cartRemove'])->name('cart.remove');
Route::get('/cart-remove-test', [CartController::class, 'cartRemoveTest'])->name('cart.remove.test');
Route::get('/cart-count', [CartController::class, 'cartCount'])->name('cart.count');
Route::get('/cart-sidebar-product', [CartController::class, 'cartSidebarProduct'])->name('cart.sidebar-product');
Route::get('/cart-sidebar-product-total', [CartController::class, 'cartSidebarProductTotal'])->name('cart.sidebar-product.total');

/* Profile */
Route::group(['middleware'=>['auth','verified'], 'prefix'=>'user', 'as'=>'user.'],function(){
   Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
   Route::get('/profile', [UserDashboardController::class, 'profile'])->name('profile');
   Route::put('/profile', [UserDashboardController::class, 'profileUpdate'])->name('profile.update');
   Route::post('profile/password', [UserDashboardController::class, 'passwordUpdate'])->name('profile.password.update');

   Route::resource('user-address', UserAddressController::class);
});
