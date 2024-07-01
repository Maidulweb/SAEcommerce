<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCatgoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\FlashSaleContorller;
use App\Http\Controllers\Backend\FooterGridThreeController;
use App\Http\Controllers\Backend\FooterGridTwoController;
use App\Http\Controllers\Backend\FooterInfoController;
use App\Http\Controllers\Backend\FooterSocialController;
use App\Http\Controllers\Backend\HomepageSettingController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PaymentSettingController;
use App\Http\Controllers\Backend\PaypalSettingController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\RazorpaySettingController;
use App\Http\Controllers\Backend\SellerProductController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\ShippingRuleController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\StripeSettingController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\TransactionController;
use App\Http\Controllers\Backend\VendorController;
use App\Models\Brand;
use App\Models\Order;
use App\Models\ShippingRule;
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

/* Coupon */
Route::put('/coupon/status', [CouponController::class, 'status'])->name('coupon.status');
Route::resource('coupon', CouponController::class);

/* Shipping Rule */
Route::put('/shipping-rule/status', [ShippingRuleController::class, 'status'])->name('shipping-rule.status');
Route::resource('shipping-rule', ShippingRuleController::class);

/* Homepage Setting */
Route::get('/homepage', [HomepageSettingController::class, 'index'])->name('homepage.index');
Route::put('/homepage/popular-product-update', [HomepageSettingController::class, 'PopularProductUpdate'])->name('homepage.popular-product.update');
Route::put('/homepage/single-category-product-update', [HomepageSettingController::class, 'singleCategoryProduct'])->name('homepage.single-category-product.update');
Route::put('/homepage/single-category-two-product-update', [HomepageSettingController::class, 'singleCategoryTwoProduct'])->name('homepage.single-category-two-product.update');
Route::put('/homepage/single-category-three-product-update', [HomepageSettingController::class, 'singleCategoryThreeProduct'])->name('homepage.single-category-three-product.update');

/* Setting */
Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
Route::put('/general-setting-update', [SettingController::class, 'generalSettingUpdate'])->name('general-setting.update');
Route::put('/smtp-setting-update', [SettingController::class, 'smtpSettingUpdate'])->name('smtp-setting.update');

/* Footer Setting */
Route::resource('footer-info', FooterInfoController::class);

Route::put('/footer-social/status', [FooterSocialController::class, 'footerSocialStatus'])->name('footer-social.status');
Route::resource('footer-social', FooterSocialController::class);

Route::put('/footer-grid-two/status', [FooterGridTwoController::class, 'footerGridTwoStatus'])->name('footer-grid-two.status');
Route::put('/footer-grid-two/title', [FooterGridTwoController::class, 'footerGridTwotitle'])->name('footer-grid-two.title');
Route::resource('footer-grid-two', FooterGridTwoController::class);

Route::put('/footer-grid-three/status', [FooterGridThreeController::class, 'footerGridThreeStatus'])->name('footer-grid-three.status');
Route::put('/footer-grid-three/title', [FooterGridThreeController::class, 'footerGridThreetitle'])->name('footer-grid-three.title');
Route::resource('footer-grid-three', FooterGridThreeController::class);

/* Payment */
Route::get('/payment-setting', [PaymentSettingController::class, 'index'])->name('payment.index');
Route::put('/paypal-setting/{id}', [PaypalSettingController::class, 'update'])->name('paypal.update');
Route::put('/stripe-setting/{id}', [StripeSettingController::class, 'update'])->name('stripe.update');

/* Order */
Route::get('/order-status', [OrderController::class, 'changeOrderStatus'])->name('order.status');
Route::get('/order-payment-status', [OrderController::class, 'changePaymentStatus'])->name('order.payment.status');
Route::get('/order-all-pending', [OrderController::class, 'orderPending'])->name('order.pending');
Route::get('/order-all-processed', [OrderController::class, 'orderProcessed'])->name('order.processed');
Route::get('/order-all-dropped', [OrderController::class, 'orderDropped'])->name('order.dropped');
Route::get('/order-all-shipped', [OrderController::class, 'orderShipped'])->name('order.shipped');
Route::get('/order-all-out-delivered', [OrderController::class, 'orderOutDelivered'])->name('order.out-delivered');
Route::get('/order-all-delivered', [OrderController::class, 'orderDelivered'])->name('order.delivered');
Route::resource('order', OrderController::class);

/* Transaction */
Route::get('transaction', [TransactionController::class, 'index'])->name('transaction.index');