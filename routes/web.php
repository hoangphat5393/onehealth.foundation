<?php

// use Illuminate\Support\Facades\Response; // JSON response
// use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::localized(function () {

    Route::get('/', '\App\Http\Controllers\PageController@index')->middleware('verified')->name('index');

    Route::group(['prefix' => 'auth'], function () {
        Route::get('/register', 'CustomerController@registerCustomer')->name('registerCustomer');
        Route::post('/register', 'Auth\RegisterController@register')->name('postRegisterCustomer');
        Route::get('/register-success', 'CustomerController@createCustomerSuccess')->name('user.register.success');
        Route::get('/login', 'CustomerController@showLoginForm')->name('user.login');
        Route::post('/login', 'CustomerController@postLogin')->name('loginCustomerAction');

        // Route::post('/logout', 'Customer\CustomerLoginController@logout')->name('CustomerLogout');
        Route::get('/logout', array('as' => 'customer.logout', 'uses' => 'CustomerController@logoutCustomer'));
        Route::post('/nap-tai-khoan', 'PaymentController@checkout')->name('customer.vnpay');
    });
    Route::post('customer/login-or-register', 'CustomerController@loginOrregister')->name('login_or_register');

    // login facebook and google
    Route::get('/social/{provider}', 'RegisterAuthController@redirectToProvider')->name('auth.social');
    Route::get('/callback/{provider}', 'RegisterAuthController@handleProviderCallback')->name('auth.social.callback');

    //user forget password
    //user forget password
    Route::group(['prefix' => 'forget'], function () {
        //user forget password
        Route::get('password', 'Auth\ForgotPasswordController@forget')->name('forgetPassword');
        Route::post('password', 'Auth\ForgotPasswordController@actionForgetPassword')->name('actionForgetPassword');

        Route::get('password-step-2', 'Auth\ForgotPasswordController@forgetPassword_step2')->name('forgetPassword_step2');
        Route::post('password-step-2', 'Auth\ForgotPasswordController@actionForgetPassword_step2')->name('actionForgetPassword_step2');

        Route::get('password-step-3', 'Auth\ForgotPasswordController@forgetPassword_step3')->name('forgetPassword_step3');
        Route::post('password-step-3', 'Auth\ForgotPasswordController@actionForgetPassword_step3')->name('actionForgetPassword_step3');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::get('/verify', 'Auth\VerificationController@show')->name('auth.verify');
            Route::post('/verify', 'Auth\VerificationController@verify');
            Route::post('/resend', 'Auth\VerificationController@resend')->name('resend');
        });
    });
    Route::group(['middleware' => ['auth']], function () {
        Route::group(['prefix' => 'customer'], function () {
            Route::get('/', 'CustomerController@index')->name('customer.dashboard');
            Route::get('/thong-tin', array('as' => 'customer.profile', 'uses' => 'CustomerController@profile'));
            Route::post('/thong-tin', array('as' => 'customer.updateprofile', 'uses' => 'CustomerController@updateProfile'));
        });
    });

    Route::group(['middleware' => 'verified'], function () {

        Route::group(['middleware' => ['auth']], function () {
            Route::group(['prefix' => 'customer'], function () {
                Route::get('/my-orders', array('as' => 'customer.my-orders', 'uses' => 'CustomerController@myOrder'));
                Route::get('/my-orders-detail/{id_cart}', array('as' => 'customer.myordersdetail', 'uses' => 'CustomerController@myOrderDetail'));
                Route::get('/my-reviews', array('as' => 'customer.reviews', 'uses' => 'CustomerController@myReviews'));

                Route::get('/quan-ly-tin-dang', array('as' => 'customer.post', 'uses' => 'CustomerController@myPost'));
                Route::get('/refused', array('as' => 'customer.refused', 'uses' => 'CustomerController@refused'));

                Route::get('/payment-point', array('as' => 'customer.payment.point', 'uses' => 'PaymentController@paymentPoint'));

                Route::get('/change-pass', array('as' => 'customer.changePassword', 'uses' => 'CustomerController@changePassword'));
                Route::post('/change-pass', array('as' => 'customer.post.ChangePassword', 'uses' => 'CustomerController@postChangePassword'));
                Route::post('/post-reviews', array('as' => 'customer.post_reviews', 'uses' => 'CustomerController@postReviews'));

                Route::get('/messages', 'CustomerController@messages')->name('customer.messages');
            });
        });

        Route::group(['prefix' => 'cart'], function () {
            Route::get('/', 'CartController@cart')->name('cart');
            Route::get('/remove', 'CartController@removeCarts')->name('carts.remove');
            Route::post('/update', 'CartController@updateCarts')->name('carts.update');
            // Route::get('/checkout', 'CartController@checkout')->name('cart.checkout');

            Route::post('/checkout-confirm', 'CartController@checkoutConfirm')->name('cart.checkout.confirm');
            Route::get('/checkout-checkemail', 'CartController@checkEmail')->name('cart.checkout.checkemail');
            Route::get('/checkout-checkphone', 'CartController@checkphone')->name('cart.checkout.checkphone');


            Route::get('/quick-buy-checkout-confirm', 'CartController@quickBuyConfirm')->name('quick_buy.get.confirm');
            Route::post('/quick-buy-checkout-confirm', 'CartController@quickBuyConfirm')->name('quick_buy.checkout.confirm');

            Route::get('/check-payment/{cart_id}', 'CartController@checkPayment')->name('cart.check_payment');

            Route::post('ajax/add', 'CartController@addCart')->name('cart.ajax.add');
            Route::post('ajax/remove', 'CartController@removeCart')->name('cart.ajax.remove');

            Route::post('ajax/get-shipping-cost', 'CartController@shipping')->name('cart.ajax.shipping');

            Route::get('checkout/success', 'CartController@success')->name('cart.checkout.success');
            Route::get('view/{id}', 'CartController@view')->name('cart.view');
        });
        Route::post('/checkout', 'CartController@checkoutConfirm')->name('cart.checkout');
        Route::get('/checkout', 'CartController@checkoutConfirm');

        Route::group(['prefix' => 'payment'], function () {
            Route::get('stripe', 'PayPalTestController@test');
            Route::post('stripe', 'PayPalTestController@testPost');

            Route::get('{cart_id}', 'PayPalTestController@paymentOrder')->name('payment.order');
        });

        // Route::get('payment', 'PayPalTestController@index');
        Route::post('checkout-process', 'CartController@checkoutProcess')->name('cart_checkout.process');
        Route::post('checkout-charge', 'PayPalTestController@charge')->name('cart.checkout.charge');
        Route::get('payment-success/{id?}', 'PayPalTestController@paymentStrip_success');
        Route::get('paymentsuccess', 'PayPalTestController@payment_success');
        Route::get('paymenterror', 'PayPalTestController@payment_error');

        //stripe response
        Route::get('stripe-success/{id?}', 'StripeController@paymentSuccess')->name('strip_payment_success');
        Route::get('stripe-cancel/{id?}', 'StripeController@paymentCancel')->name('strip_payment_cancel');
        // Route::post('stripe-webhook', 'StripeController@paymentWebhook');
        Route::post('stripe-webhook', 'WebhookController@handleWebhook');

        //request payment
        Route::get('request-payment-success/{id}', 'CartController@requestPaymentSuccess')->name('request_payment_success');
        Route::post('send-request-payment-success', 'CartController@post_requestPaymentSuccess')->name('request_payment_success.post');

        // Route::get('/contact-submit', array('as' => 'contact.submit', 'uses' => 'CustomerController@contactSend'));

        Route::post('/dang-ky-nhan-tin', array('as' => 'subscription', 'uses' => 'CustomerController@subscription'));


        Route::get('/wishlist', array('as' => 'customer.wishlist', 'uses' => 'CustomerController@wishlist'));
        Route::post('add-to-wishlist', 'ProductController@wishlist')->name('product.wishlist');

        Route::get('news.html', 'NewsController@index')->name('news');

        // Category
        Route::get('shop', 'ProductController@allProducts')->name('shop');
        Route::get('{slug}.html', 'ProductController@categoryDetail')->name('product.detail');

        Route::post('quick-view', 'ProductController@quickView')->name('shop.quickView');
        Route::get('buy-now/{id}', 'ProductController@buyNow')->name('shop.buyNow');
        Route::post('buy-now', 'ProductController@getBuyNow')->name('shop.buyNow.post');

        // All news
        Route::get('news', '\App\Http\Controllers\NewsController@index')->name('news');

        // News detail 
        Route::get('news/{slug}-{id}.html', '\App\Http\Controllers\NewsController@newsDetail')
            ->where(['slug' => '[a-zA-Z0-9$-_.+!]+', 'id' => '[0-9]+'])
            ->name('news.detail');

        // News category 
        Route::get('news/{slug}.html', '\App\Http\Controllers\NewsController@index')
            ->where(['slug' => '[a-zA-Z0-9$-_.+!]+'])
            ->name('news.category');

        //contact
        Route::post('/get-contact-form/{type}', array('as' => 'contact.get', 'uses' => 'ContactController@getContact'));
        Route::get('contact', 'ContactController@index')->name('contact');
        Route::post('contact-confirmation', 'ContactController@confirmation')->name('contact.confirmation');
        Route::post('contact', 'ContactController@submit')->name('contact.submit');
        Route::get('contact-completed', 'ContactController@completed')->name('contact_completed');

        // Setup 
        Route::get('setup', 'SetupController@index')->name('setup');
        Route::post('setup-confirmation', 'SetupController@confirmation')->name('setup.confirmation');
        Route::post('setup', 'SetupController@submit')->name('setup.submit');
        Route::get('setup-completed', 'SetupController@completed')->name('setup_completed');

        //search
        Route::post('/input/search-text/{type}', 'AjaxController@inputSearchText');

        Route::get('/search', '\App\Http\Controllers\SearchController@index')->name('search');
        Route::post('search-select', 'AjaxController@searchSelect');

        //page
        Route::get('{slug}', 'PageController@page')->name('page');

        //project
        Route::get('du-an/{slug}-{id}.html', '\App\Http\Controllers\ProjectController@detail')
            ->where(['slug' => '[a-zA-Z0-9$-_.+!]+', 'id' => '[0-9]+'])
            ->name('project.detail');

        Route::get('du-an/{slug}.html', '\App\Http\Controllers\ProjectController@category')
            ->where(['slug' => '[a-zA-Z0-9$-_.+!]+'])
            ->name('project.category');
        //end project
    });

    Route::group(['prefix' => 'ajax'], function () {
        Route::post('change-attr', 'ProductController@changeAttr')->name('ajax.attr.change');
        Route::post('order-view', 'CustomerController@orderView');
    });
});
