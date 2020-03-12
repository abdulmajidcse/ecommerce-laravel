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
    Route::post('/logout', 'Auth\Admin\LoginController@logout')->name('admin.logout');
    Route::get('/password/reset', 'Auth\Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');

    //authenticate routes are here
    Route::middleware(['auth:admin'])->group(function (){
        Route::get('/', 'admin\AdminController@index')->name('admin.dashboard');

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
            Route::get('/view/{id}', 'admin\DistrictController@show')->name('admin.orders.show');
            Route::get('/delete/{id}', 'admin\DistrictController@destroy')->name('admin.orders.delete');
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
	Route::post('/store/{id}', 'frontend\CartController@store');
	Route::post('/update/{id}', 'frontend\CartController@update');
	Route::get('/delete/{id}', 'frontend\CartController@destroy');
});

//checkout crud are here
Route::prefix('/checkout')->group(function(){
	Route::get('/', 'frontend\CheckoutController@index');
	Route::get('/select-payment-method/{payment_method_id}', 'frontend\CheckoutController@selectPaymentMethod');
	Route::post('/confirm', 'frontend\CheckoutController@store');
});



