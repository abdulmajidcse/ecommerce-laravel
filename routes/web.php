<?php

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

Auth::routes();

/*
|-----------------------------------------------------------------------
| admin routes
|-----------------------------------------------------------------------
|
| Here is a group of admin routes and all others route. This routes are
| controlled by admin
|
*/

Route::prefix('/admin')->group(function(){
    //Admin login routes
    Route::get('/login', 'Auth\Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login/submit', 'Auth\Admin\LoginController@login')->name('admin.login.submit');
    Route::get('password/reset', 'Auth\Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('password/email', 'Auth\Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('password/reset/{token}', 'Auth\Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('password/reset', 'Auth\Admin\ResetPasswordController@reset')->name('admin.password.update');

    //authenticate routes are here
    Route::middleware(['auth:admin'])->group(function (){
        //admin profile routes are here
        Route::get('/', 'admin\AdminController@index')->name('admin.dashboard');
        Route::get('/profile', 'admin\AdminController@profile')->name('admin.profile');
        Route::get('/edit-profile/{id}', 'admin\AdminController@edit')->name('admin.editProfile');
        Route::post('/update-profile/{id}', 'admin\AdminController@update')->name('admin.updateProfile');
        Route::get('/change-password', 'admin\AdminController@changePassword')->name('admin.changePassword');
        Route::post('/update-password/', 'admin\AdminController@updatePassword')->name('admin.updatePassword');

        //category crud are here
        Route::prefix('/categories')->group(function(){
            Route::get('/', 'admin\CategoryController@index');
            Route::get('/add', 'admin\CategoryController@create');
            Route::get('/edit/{id}', 'admin\CategoryController@edit');
            Route::post('/update/{id}', 'admin\CategoryController@update');
            Route::get('/delete/{id}', 'admin\CategoryController@destroy');
            Route::post('/store', 'admin\CategoryController@store')->name('category-store');
        });

        //brand crud are here
        Route::prefix('/brands')->group(function(){
            Route::get('/', 'admin\BrandController@index');
            Route::get('/add', 'admin\BrandController@create');
            Route::get('/edit/{id}', 'admin\BrandController@edit');
            Route::post('/update/{id}', 'admin\BrandController@update');
            Route::get('/delete/{id}', 'admin\BrandController@destroy');
            Route::post('/store', 'admin\BrandController@store');
        });

        //product crud are here
        Route::prefix('/products')->group(function(){
            Route::get('/', 'admin\ProductController@index');
            Route::get('/add', 'admin\ProductController@create');
            Route::post('/store', 'admin\ProductController@store');
            Route::get('/delete/{id}', 'admin\ProductController@destroy');
            Route::get('/edit/{id}', 'admin\ProductController@edit');
            Route::post('/update/{id}', 'admin\ProductController@update');
        });

        //division crud are here
        Route::prefix('/divisions')->group(function(){
            Route::get('/', 'admin\DivisionController@index');
            Route::get('/add', 'admin\DivisionController@create');
            Route::post('/store', 'admin\DivisionController@store');
            Route::get('/delete/{id}', 'admin\DivisionController@destroy');
            Route::get('/edit/{id}', 'admin\DivisionController@edit');
            Route::post('/update/{id}', 'admin\DivisionController@update');
        });

        //district crud are here
        Route::prefix('/districts')->group(function(){
            Route::get('/', 'admin\DistrictController@index');
            Route::get('/add', 'admin\DistrictController@create');
            Route::post('/store', 'admin\DistrictController@store');
            Route::get('/delete/{id}', 'admin\DistrictController@destroy');
            Route::get('/edit/{id}', 'admin\DistrictController@edit');
            Route::post('/update/{id}', 'admin\DistrictController@update');
        });

        //orders route here
        Route::prefix('/orders')->group(function(){
            Route::get('/', 'admin\OrdersController@index')->name('admin.orders');
            Route::get('/view/{id}', 'admin\OrdersController@show')->name('admin.orders.show');
            Route::post('/cart/update/{id}', 'admin\OrdersController@cartUpdate')->name('admin.cart.update');
            Route::post('/offer/{id}', 'admin\OrdersController@giveOffer');
            Route::get('/cart/delete/{id}', 'admin\OrdersController@cartDestroy')->name('admin.orders.delete');
            Route::get('/delete/{id}', 'admin\OrdersController@destroy')->name('admin.orders.delete');
            Route::get('/complete/{id}', 'admin\OrdersController@complete')->name('admin.orders.complete');
            Route::get('/paid/{id}', 'admin\OrdersController@paid')->name('admin.orders.paid');
            Route::get('/invoice/{id}', 'admin\OrdersController@invoice')->name('admin.orders.invoice');
        });

        //slider crud are here
        Route::prefix('/sliders')->group(function(){
            Route::get('/', 'admin\SliderController@index');
            Route::get('/add', 'admin\SliderController@create');
            Route::post('/store', 'admin\SliderController@store');
            Route::get('/delete/{id}', 'admin\SliderController@destroy');
        });

        //settings routes
        Route::prefix('/settings')->group(function(){
            Route::get('/', 'admin\SettingsController@index');
            Route::get('/add', 'admin\SettingsController@create');
            Route::post('/store', 'admin\SettingsController@store');
            Route::get('/edit/{id}', 'admin\SettingsController@edit');
            Route::post('/update/{id}', 'admin\SettingsController@update');
        });

        //payment systems routes
        Route::prefix('/payment-systems')->group(function(){
            Route::get('/', 'admin\PaymentSystemsController@index');
            Route::get('/add', 'admin\PaymentSystemsController@create');
            Route::post('/store', 'admin\PaymentSystemsController@store');
            Route::get('/edit/{id}', 'admin\PaymentSystemsController@edit');
            Route::post('/update/{id}', 'admin\PaymentSystemsController@update');
            Route::get('/delete/{id}', 'admin\PaymentSystemsController@destroy');
        });

        //subscriber view and delete routes
        Route::prefix('/subscribers')->group(function(){
            Route::get('/', 'admin\SubscriberController@index');
            Route::get('/delete/{id}', 'admin\SubscriberController@destroy');
        });

        //customers routes
        Route::prefix('/customers')->group(function(){
            Route::get('/', 'admin\CustomerController@index');
            Route::get('/change-status/{id}/{status}', 'admin\CustomerController@changeStatus');
            Route::get('/delete/{id}', 'admin\CustomerController@destroy');
        });

        //custom pages routes
        Route::prefix('/custom-pages')->group(function(){
            Route::get('/', 'admin\CustomPageController@index');
            Route::get('/add', 'admin\CustomPageController@create');
            Route::post('/store', 'admin\CustomPageController@store');
            Route::get('/edit/{id}', 'admin\CustomPageController@edit');
            Route::get('/view/{id}', 'admin\CustomPageController@show');
            Route::post('/update/{id}', 'admin\CustomPageController@update');
            Route::get('/delete/{id}', 'admin\CustomPageController@destroy');
        });

        //social contact routes
        Route::prefix('/social-contacts')->group(function(){
            Route::get('/', 'admin\SocialContactController@index');
            Route::get('/add', 'admin\SocialContactController@create');
            Route::post('/store', 'admin\SocialContactController@store');
            Route::get('/edit/{id}', 'admin\SocialContactController@edit');
            Route::post('/update/{id}', 'admin\SocialContactController@update');
            Route::get('/delete/{id}', 'admin\SocialContactController@destroy');
        });

    });

});

/*
|-----------------------------------------------------------------------
| user routes and frontend view routes
|-----------------------------------------------------------------------
|
| Here is a group of user routes and all others route.
|
*/

//frontend home page route
Route::get('/', 'HomeController@index')->name('home');


/*
 * User registration and login route and dashboard route here
*/

Route::prefix('/user')->group(function(){

	//select all district by division for user registration
	Route::get('/district/select/{division_id}', 'Auth\RegisterController@select_district');
	Route::get('/edit-profile/district/select/{division_id}', 'frontend\UsersController@selectDistrict');
	//user register verify
	Route::get('/verify-token/{token}', 'frontend\RegisterVerifyController@verifyToken');

    Route::middleware(['auth:web'])->group(function (){
        //user dashboard
        Route::get('/dashboard', 'frontend\UsersController@dashboard')->name('user.dashboard');
        //show user profile information for edit in the edit page
        Route::get('/edit', 'frontend\UsersController@edit');
        Route::post('/update', 'frontend\UsersController@update');
        Route::get('/change-password', 'frontend\UsersController@changePassword');
        Route::post('/change-password-store', 'frontend\UsersController@changePasswordStore');
    });

});



/*

 * frontend product route here and its manage by pagescontroller

*/
Route::get('/single-product/{slug}', 'frontend\PagesController@singleProduct');
Route::get('/category-product/{name}', 'frontend\PagesController@categoryProduct');
Route::get('/brand-product/{name}', 'frontend\PagesController@brandProduct');
Route::get('/search-product', 'frontend\PagesController@searchProduct');

//carts crud are here
Route::prefix('/carts')->group(function(){
	Route::get('/', 'frontend\CartController@index');
	Route::post('/store', 'frontend\CartController@store');
	Route::post('/update/{id}', 'frontend\CartController@update');
	Route::get('/delete/{id}', 'frontend\CartController@destroy');
});

//checkout crud are here
Route::prefix('/checkout')->group(function(){
	Route::get('/', 'frontend\CheckoutController@index');
	Route::get('/select-payment-method/{payment_method_id}', 'frontend\CheckoutController@selectPaymentMethod');
	Route::post('/confirm', 'frontend\CheckoutController@store');
    Route::get('/invoice/{id}', 'frontend\CheckoutController@checkOutInvoice');
});

//add new subscriber 
Route::post('/subscriber/store', 'admin\SubscriberController@store');

//custom pages show route
Route::get('page/{slug}', 'frontend\PagesController@customPageShow');


