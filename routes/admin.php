<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCatgoryController;
use App\Http\Controllers\Backend\FlashSaleContorller;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SellerProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\VendorController;
use App\Models\Brand;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');
Route::post('password', [ProfileController::class, 'passwordUpdate'])->name('password.update');

Route::resource('slider', SliderController::class);

Route::put('/category/status', [CategoryController::class, 'categoryStatus'])->name('category.status');
Route::resource('category', CategoryController::class);

Route::put('/sub-category/status', [SubCategoryController::class, 'subcategoryStatus'])->name('subcategory.status');
Route::resource('sub-category', SubCategoryController::class);

Route::get('/child-category/sub-category', [ChildCatgoryController::class, 'childcategorySubCategory'])->name('childcategory.sub-category');
Route::put('/child-category/status', [ChildCatgoryController::class, 'childcategoryStatus'])->name('childcategory.status');
Route::resource('child-category', ChildCatgoryController::class);

Route::put('/brand/status', [BrandController::class, 'status'])->name('brand.status');
Route::resource('brand', BrandController::class);

Route::resource('vendor-profile', AdminVendorProfileController::class);

Route::get('product/sub-category', [ProductController::class, 'subCategory'])->name('product.sub-category');
Route::get('product/child-category', [ProductController::class, 'childCategory'])->name('product.child-category');
Route::post('product/status', [ProductController::class, 'status'])->name('product.status');
Route::resource('product', ProductController::class);

Route::resource('product-image-gallery', ProductImageGalleryController::class);

Route::post('product-variant/status', [ProductVariantController::class, 'status'])->name('product-variant.status');
Route::resource('product-variant', ProductVariantController::class);

/* Product Variant Item */
Route::get('product-variant-item/{productId}/{variantId}', [ProductVariantItemController::class, 'index'])->name('product-variant-item.index');
Route::get('product-variant-item/{productId}/{variantId}/create', [ProductVariantItemController::class, 'create'])->name('product-variant-item.create');
Route::post('product-variant-item', [ProductVariantItemController::class, 'store'])->name('product-variant-item.store');
Route::get('product-variant-item-edit/{id}', [ProductVariantItemController::class, 'edit'])->name('product-variant-item.edit');
Route::post('product-variant-item-edit/{id}', [ProductVariantItemController::class, 'update'])->name('product-variant-item.update');
Route::delete('product-variant-item-destroy/{id}', [ProductVariantItemController::class, 'destroy'])->name('product-variant-item.delete');
Route::post('product-variant-item/status', [ProductVariantItemController::class, 'status'])->name('product-variant-item.status');

/* Seller Product */
Route::get('seller-product', [SellerProductController::class, 'index'])->name('seller-product.index');
Route::put('seller-product-pending', [SellerProductController::class, 'sellerProductPending'])->name('seller-product-pending.update');
Route::get('pending-product', [SellerProductController::class, 'pendingProduct'])->name('pending-product.index');
Route::put('seller-product-approved', [SellerProductController::class, 'sellerProductApproved'])->name('pending-product-approved.update');

/* Flash Sale Product */
Route::get('flash-sale-product', [FlashSaleContorller::class, 'index'])->name('flash-sale-product.index');
Route::put('flash-sale-product', [FlashSaleContorller::class, 'update'])->name('flash-sale-product.update');
Route::post('flash-sale-item-product', [FlashSaleContorller::class, 'store'])->name('flash-sale-item-product.store');
Route::put('flash-sale-item-product/status', [FlashSaleContorller::class, 'status'])->name('flash-sale-item-product.status');
Route::delete('flash-sale-item-product/delete/{id}', [FlashSaleContorller::class, 'destroy'])->name('flash-sale-item-product.delete');