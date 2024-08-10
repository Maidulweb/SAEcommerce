<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\UserOrderController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\FrontendProductController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsletterController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ProductReviewController;
use App\Http\Controllers\Frontend\TrackOrderController;
use App\Http\Controllers\Frontend\UserAddressController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UserMessengerController;
use App\Http\Controllers\Frontend\VendorController;
use App\Http\Controllers\Frontend\WishListController;
use App\Http\Controllers\ProfileController;
use App\Models\ProductReview;
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
Route::get('/products', [FrontendProductController::class, 'products'])->name('frontend.products');
Route::get('/change-grid-view', [FrontendProductController::class, 'changeGridView'])->name('frontend.products.change-grid-view');

Route::post('newsletter', [NewsletterController::class, 'newsletter'])->name('newsletter');
Route::get('newsletter-verify/{token}', [NewsletterController::class, 'newsLetterEmailVarify'])->name('newsletter-verify');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



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
Route::get('/coupon-apply', [CartController::class, 'couponApply'])->name('coupon-apply');
Route::get('/coupon-calculation', [CartController::class, 'couponCalculation'])->name('coupon-calculation');

/* Profile */
Route::group(['middleware'=>['auth','verified'], 'prefix'=>'user', 'as'=>'user.'],function(){
   Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
   Route::get('/profile', [UserDashboardController::class, 'profile'])->name('profile');
   Route::put('/profile', [UserDashboardController::class, 'profileUpdate'])->name('profile.update');
   Route::post('profile/password', [UserDashboardController::class, 'passwordUpdate'])->name('profile.password.update');

   Route::resource('user-address', UserAddressController::class);

   /* Checkout */
   Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout');
   Route::post('checkout', [CheckoutController::class, 'store'])->name('checkout.store');
   Route::post('checkout/form-submit', [CheckoutController::class, 'formSubmit'])->name('checkout.form-submit');
   /* Wishlist */
   Route::get('wishlist', [WishListController::class, 'index'])->name('wishlist.index');
   Route::post('wishlist', [WishListController::class, 'store'])->name('wishlist.store');
   Route::get('wishlist/{id}', [WishListController::class, 'destroy'])->name('wishlist.destroy');

   /* Payment */
   Route::get('payment', [PaymentController::class, 'index'])->name('payment');
   Route::get('payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
   /* Paypal */
   Route::get('paypal/payment', [PaymentController::class, 'paypal'])->name('paypal.payment');
   Route::get('paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.payment.success');
   Route::get('paypal/payment/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.payment.cancel');

   /* Stripe */
   Route::post('stripe/payment', [PaymentController::class, 'stripe'])->name('stripe.payment');

   Route::get('cod/payment', [PaymentController::class, 'cod'])->name('cod.payment');

   /* Order */
   Route::get('order', [UserOrderController::class, 'index'])->name('order.index');
   Route::get('order/{id}', [UserOrderController::class, 'show'])->name('order.show');

   Route::get('product-review', [ProductReviewController::class, 'index'])->name('product-review.index');
   Route::post('product-review', [ProductReviewController::class, 'create'])->name('product-review.create');

   /* Blog Comment */
   Route::post('blog-comment', [BlogController::class, 'comment'])->name('blog.comment');

   /* Messenger */
   Route::get('/messenger', [UserMessengerController::class, 'index'])->name('messenger.index');
   Route::post('/user-send-message', [UserMessengerController::class, 'sendMessage'])->name('send-message');
   Route::get('/get-messages', [UserMessengerController::class, 'getMessages'])->name('get-messages');
});

/* Vendor */
Route::get('pages/vendor', [VendorController::class, 'index'])->name('vendor.index');
Route::get('pages/vendor-products/{id}', [VendorController::class, 'products'])->name('vendor.products');
Route::get('pages/vendor-request', [VendorController::class, 'vendorRequestPage'])->name('vendor.request-page');
Route::post('pages/vendor-request', [VendorController::class, 'vendorRequestCreate'])->name('vendor.request-page.create');

/* Contact */
Route::get('contact', [PageController::class, 'contact'])->name('contact');
Route::post('contact', [PageController::class, 'handleContact'])->name('handle.contact');

/* Track Order */
Route::get('track-order', [TrackOrderController::class, 'index'])->name('track-order');

/* Blog */
Route::get('blog-all', [BlogController::class, 'index'])->name('frontend.blog-all');
Route::get('blog-single/{slug}', [BlogController::class, 'singleBlog'])->name('frontend.blog-single');
Route::get('blog-category-post/{id}', [BlogController::class, 'categoryBlogPost'])->name('frontend.blog-category-post');

/* Modal */
Route::get('product-modal/{id}', [HomeController::class, 'modal'])->name('product.modal');



