<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorMessengerController;
use App\Http\Controllers\Backend\VendorOrderController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProductImageGalleryController;
use App\Http\Controllers\Backend\VendorProductReviewController;
use App\Http\Controllers\Backend\VendorProductVariantController;
use App\Http\Controllers\Backend\VendorProductVariantItemController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorShopProfileController;
use App\Http\Controllers\vendor\WithdrawVendorRequestController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
Route::get('profile', [VendorProfileController::class, 'index'])->name('profile');
Route::put('profile', [VendorProfileController::class, 'profileUpdate'])->name('profile.update');
Route::post('password', [VendorProfileController::class, 'passwordUpdate'])->name('password.update');

Route::resource('shop-profile', VendorShopProfileController::class);
/* Product */
Route::get('product/sub-category', [VendorProductController::class, 'subCategory'])->name('product.sub-category');
Route::get('product/child-category', [VendorProductController::class, 'childCategory'])->name('product.child-category');
Route::post('product/status', [VendorProductController::class, 'status'])->name('product.status');
Route::resource('product', VendorProductController::class);

Route::resource('product-image-gallery', VendorProductImageGalleryController::class);

Route::post('product-variant/status', [VendorProductVariantController::class, 'status'])->name('product-variant.status');
Route::resource('product-variant', VendorProductVariantController::class);

Route::get('product-variant-item/{productId}/{variantId}', [VendorProductVariantItemController::class, 'index'])->name('product-variant-item.index');
Route::get('product-variant-item/{productId}/{variantId}/create', [VendorProductVariantItemController::class, 'create'])->name('product-variant-item.create');
Route::post('product-variant-item', [VendorProductVariantItemController::class, 'store'])->name('product-variant-item.store');
Route::get('product-variant-item-edit/{id}', [VendorProductVariantItemController::class, 'edit'])->name('product-variant-item.edit');
Route::post('product-variant-item-edit/{id}', [VendorProductVariantItemController::class, 'update'])->name('product-variant-item.update');
Route::delete('product-variant-item-destroy/{id}', [VendorProductVariantItemController::class, 'destroy'])->name('product-variant-item.delete');
Route::post('product-variant-item/status', [VendorProductVariantItemController::class, 'status'])->name('product-variant-item.status');

/** Order */
Route::get('vendor-order', [VendorOrderController::class, 'index'])->name('order.index');
Route::get('vendor-order/{id}', [VendorOrderController::class, 'show'])->name('order.show');
Route::post('vendor-order/status/{id}', [VendorOrderController::class, 'changeOrderStatus'])->name('order.status');

/* Product Review */
Route::get('product-review', [VendorProductReviewController::class, 'index'])->name('product-review.index');

/* Withdraw */
Route::get('withdraw/view/{id}', [WithdrawVendorRequestController::class, 'view'])->name('withdraw.view');
Route::resource('withdraw', WithdrawVendorRequestController::class);

/* Messenger */
Route::get('messenger', [VendorMessengerController::class, 'index'])->name('messenger.index');