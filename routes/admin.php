<?php

use App\DataTables\AdminVendorWithdrawRequestDataTable;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminListController;
use App\Http\Controllers\Backend\AdminProductReviewController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\AdminVendorWithdrawRequestController;
use App\Http\Controllers\Backend\AdvertisementController;
use App\Http\Controllers\Backend\BlogCategoryController;
use App\Http\Controllers\Backend\BlogCommentController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCatgoryController;
use App\Http\Controllers\Backend\CodController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\CustomerListController;
use App\Http\Controllers\Backend\FlashSaleContorller;
use App\Http\Controllers\Backend\FooterGridThreeController;
use App\Http\Controllers\Backend\FooterGridTwoController;
use App\Http\Controllers\Backend\FooterInfoController;
use App\Http\Controllers\Backend\FooterSocialController;
use App\Http\Controllers\Backend\HomepageSettingController;
use App\Http\Controllers\Backend\LogoController;
use App\Http\Controllers\Backend\ManageUserController;
use App\Http\Controllers\Backend\MessengerController;
use App\Http\Controllers\Backend\NewsletterSubscriberController;
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
use App\Http\Controllers\Backend\TrackOrderController;
use App\Http\Controllers\Backend\TransactionController;
use App\Http\Controllers\Backend\VendorConditionController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\WithdrawMethodController;
use App\Http\Controllers\Frontend\NewsletterController;
use App\Models\Advertisement;
use App\Models\BlogCategory;
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
Route::put('logo-setting', [SettingController::class, 'logoUpdate'])->name('logo.setting');
Route::put('pusher-setting', [SettingController::class, 'pusherSettingUpdate'])->name('pusher.setting');

/* Newsletter Subscriber */
Route::get('subscriber', [NewsletterSubscriberController::class, 'index'])->name('newsletter-subscriber.index');
Route::delete('subscriber/{id}', [NewsletterSubscriberController::class, 'destroy'])->name('newsletter-subscriber.destroy');
Route::post('subscriber-send-mail', [NewsletterSubscriberController::class, 'sendMail'])->name('subscriber-send-mail');

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
Route::put('/cod-setting/{id}', [CodController::class, 'update'])->name('cod.update');

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

/* Advertisement Banner */
Route::get('advertisement', [AdvertisementController::class, 'index'])->name('advertisement');
Route::put('advertisement-banner-one', [AdvertisementController::class, 'advertisementBannerOne'])->name('advertisement-banner-one');
Route::put('advertisement-banner-two', [AdvertisementController::class, 'advertisementBannerTwo'])->name('advertisement-banner-two');
Route::put('advertisement-banner-three', [AdvertisementController::class, 'advertisementBannerThree'])->name('advertisement-banner-three');
Route::put('advertisement-banner-four', [AdvertisementController::class, 'advertisementBannerFour'])->name('advertisement-banner-four');

/* Product Review */
Route::get('product-review', [AdminProductReviewController::class, 'index'])->name('product-review.index');
Route::put('product-review/status', [AdminProductReviewController::class, 'status'])->name('product-review.status');

/* Vendor */
Route::get('vendor-request', [AdminVendorProfileController::class, 'vendorRequest'])->name('vendor-request');
Route::get('vendor-request/{id}', [AdminVendorProfileController::class, 'vendorRequestSingle'])->name('vendor-request.single');
Route::put('vendor-request/status/{id}', [AdminVendorProfileController::class, 'vendorRequestStatus'])->name('vendor-request.status');
Route::get('vendor-list', [AdminVendorProfileController::class, 'vendorList'])->name('vendor-list');
Route::put('vendor-list/status', [AdminVendorProfileController::class, 'vendorListStatus'])->name('vendor-list.status');
Route::resource('vendor-profile', AdminVendorProfileController::class);

Route::get('vendor-condition', [VendorConditionController::class, 'index'])->name('vendor-condition');
Route::put('vendor-condition', [VendorConditionController::class, 'update'])->name('vendor-condition.update');

/* Customer */
Route::get('customer', [CustomerListController::class, 'index'])->name('customer-list');
Route::put('customer/status-change', [CustomerListController::class, 'customerStatus'])->name('customer-list.status');

/* Manage User */
Route::get('manage-user', [ManageUserController::class, 'index'])->name('manage-user');
Route::post('manage-user', [ManageUserController::class, 'store'])->name('manage-user.store');

/* Admin List */
Route::get('admin-list', [AdminListController::class, 'index'])->name('admin-list');
Route::put('admin-list/status', [AdminListController::class, 'adminListStatus'])->name('admin-list.status');
Route::delete('admin-list/{id}', [AdminListController::class, 'destroy'])->name('admin-list.destroy');

/* Blog */
Route::put('blog-category/status', [BlogCategoryController::class, 'status'])->name('blog-category.status');
Route::resource('blog-category', BlogCategoryController::class);

Route::put('blog/status', [BlogController::class, 'status'])->name('blog.status');
Route::resource('blog', BlogController::class);

Route::get('blog-comment', [BlogCommentController::class, 'index'])->name('blog-comment');
Route::delete('blog-comment/{id}', [BlogCommentController::class, 'destroy'])->name('blog-comment.destroy');

/* Withdraw Method */
Route::resource('withdraw', WithdrawMethodController::class);

Route::get('vendor-withdraw-request', [AdminVendorWithdrawRequestController::class, 'index'])->name('vendor-withdraw-request.index');
Route::get('vendor-withdraw-request/{id}', [AdminVendorWithdrawRequestController::class, 'show'])->name('vendor-withdraw-request.show');
Route::put('vendor-withdraw-request/{id}', [AdminVendorWithdrawRequestController::class, 'update'])->name('vendor-withdraw-request.update');

/* Messenger */
Route::get('messenger', [MessengerController::class, 'index'])->name('messenger');
Route::get('get-messages', [MessengerController::class, 'getMessages'])->name('get-messages');
Route::post('send-message', [MessengerController::class, 'sendMessage'])->name('send-message');