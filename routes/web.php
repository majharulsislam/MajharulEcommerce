<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPagesController;
use App\Http\Controllers\PagesController;

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

Route::get('/welcome', function () {
   return view('welcome');
});


// =============> Start Backend <==================

// Admin Login Route
    Route::group(['namespace' => 'App\Http\Controllers\Auth\Admin'], function(){

        // Admin Login Route
        Route::get('/admin/login','LoginController@showLoginForm')->name('admin.login');
        Route::post('/admin/submit','LoginController@login')->name('admin.login.submit');
        Route::post('/admin/logout','LoginController@logout')->name('admin.logout.submit');

        // send email for forgot password
        Route::get('/admin/password/reset','ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
        Route::post('/admin/password/email','ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');

        // Reset Password
        Route::get('/admin/password/reset/{token}','ResetPasswordController@showResetForm')->name('admin.password.reset');
        Route::post('/admin/password/reset/update','ResetPasswordController@reset')->name('admin.password.update');

    });


// Admin Pages Route
    Route::group(['namespace' => 'App\Http\Controllers'], function(){
        Route::get('/admin','AdminPagesController@index')->name('admin.index');
    });


// Admin Product Route
    Route::group(['namespace' => 'App\Http\Controllers'], function(){

        Route::group(['prefix' => 'admin/product'],function(){
            Route::get('/manage','ProductController@manageproduct')->name('admin.manageproduct');
            Route::get('/create','ProductController@create')->name('admin.create');
            Route::post('/store','ProductController@store')->name('product.store');
            Route::get('/edit/{id}','ProductController@edit')->name('admin.product.edit');
            Route::post('/update/{id}','ProductController@update')->name('admin.product.update');
            Route::get('/delete/{id}','ProductController@destroy')->name('admin.product.delete');
        });
    });


// Admin Orders Route
    Route::group(['namespace' => 'App\Http\Controllers'], function(){
            
        Route::group(['prefix' => 'admin/product/orders'],function(){
            Route::get('/manage','OrderController@index')->name('admin.manage.order');
            Route::get('/show/{id}','OrderController@show')->name('admin.show.order');
            Route::get('/delete/{id}','OrderController@destroy')->name('admin.order.delete');
            Route::post('/completed/{id}','OrderController@complete')->name('admin.order.complete');
            Route::post('/paid/{id}','OrderController@paid')->name('admin.order.paid');
            Route::post('/charge-update/{id}','OrderController@chargeUpdate')->name('admin.order.charge');
            Route::get('/generate-invoice/{id}','OrderController@generateInvoice')->name('admin.order.invoice');
        });

    });


// Admin Category Route
    Route::group(['namespace' => 'App\Http\Controllers'], function(){
            
        Route::group(['prefix' => 'admin/product/category'],function(){
            Route::get('/manage','CategoryController@index')->name('admin.managecategory');
            Route::get('/create','CategoryController@create')->name('admin.category.create');
            Route::post('/store','CategoryController@store')->name('admin.category.store');
            Route::get('/edit/{id}','CategoryController@edit')->name('admin.category.edit');
            Route::post('/update/{id}','CategoryController@update')->name('admin.category.update');
            Route::get('/delete/{id}','CategoryController@destroy')->name('admin.category.delete');
        });

    });

// Admin Brand Route
    Route::group(['namespace' => 'App\Http\Controllers'], function(){
            
        Route::group(['prefix' => 'admin/product/brand'],function(){
            Route::get('/manage','BrandController@index')->name('admin.managebrands');
            Route::get('/create','BrandController@create')->name('admin.brand.create');
            Route::post('/store','BrandController@store')->name('admin.brand.store');
            Route::get('/edit/{id}','BrandController@edit')->name('admin.brand.edit');
            Route::post('/update/{id}','BrandController@update')->name('admin.brand.update');
            Route::get('/delete/{id}','BrandController@destroy')->name('admin.brand.delete');
        });

    });

// Division Route
    Route::group(['namespace' => 'App\Http\Controllers'], function(){
            
        Route::group(['prefix' => 'admin/division'],function(){
            Route::get('/manage','DivisionsController@index')->name('admin.managedivision');
            Route::get('/create','DivisionsController@create')->name('admin.division.create');
            Route::post('/store','DivisionsController@store')->name('admin.division.store');
            Route::get('/edit/{id}','DivisionsController@edit')->name('admin.division.edit');
            Route::post('/update/{id}','DivisionsController@update')->name('admin.division.update');
            Route::get('/delete/{id}','DivisionsController@destroy')->name('admin.division.delete');
        });

    });

// District Route
    Route::group(['namespace' => 'App\Http\Controllers'], function(){
            
        Route::group(['prefix' => 'admin/district'],function(){
            Route::get('/manage','DistrictsController@index')->name('admin.managedistrict');
            Route::get('/create','DistrictsController@create')->name('admin.district.create');
            Route::post('/store','DistrictsController@store')->name('admin.district.store');
            Route::get('/edit/{id}','DistrictsController@edit')->name('admin.district.edit');
            Route::post('/update/{id}','DistrictsController@update')->name('admin.district.update');
            Route::get('/delete/{id}','DistrictsController@destroy')->name('admin.district.delete');
        });

    });


// Slider Route
    Route::group(['namespace' => 'App\Http\Controllers'], function(){
            
        Route::group(['prefix' => 'admin/slider'],function(){
            Route::get('/','SliderController@index')->name('admin.slider.index');
            Route::post('/store','SliderController@store')->name('admin.slider.store');
            Route::post('/update/{id}','SliderController@update')->name('admin.slider.update');
            Route::get('/delete/{id}','SliderController@destroy')->name('admin.slider.delete');
        });

    }); 





// ===========>> Start Frontend <<==============

//  User Authentication route
    Auth::routes();
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/token/{token}', [App\Http\Controllers\VerifyController::class, 'verify'])->name('user.verification');


// Public route
    Route::group(['namespace'=> 'App\Http\Controllers'],function(){

        Route::get('/','PagesController@index')->name('index');
        Route::get('/products','PagesController@products')->name('products');
        Route::get('/products/{slug}','PagesController@show')->name('products.show');
        Route::get('/search','PagesController@search')->name('product.search');

        // show product category base
        Route::get('product/categories','PagesController@categories')->name('product.category.index');
        Route::get('/product/categories/{id}','PagesController@showcategory')->name('product.category.show');

    });


// front-end user dashboard
    Route::group(['namespace' => 'App\Http\Controllers'], function(){
        Route::group(['prefix' => 'user'], function(){
            Route::get('/dashboard','UserController@dashboard')->name('user.dashboard');
            Route::get('/profile','UserController@profile')->name('user.profile');
            Route::post('/profile/update','UserController@profileUpdate')->name('user.profile.update');
        });
    });


// add to Cart button
    Route::group(['namespace' => 'App\Http\Controllers'], function(){
        Route::group(['prefix' => 'cart'], function(){
            Route::get('/','CartController@index')->name('carts.index');
            Route::post('/store','CartController@store')->name('carts.store');
            Route::post('/update/{id}','CartController@update')->name('carts.update');
            Route::get('/delete/{id}','CartController@destroy')->name('carts.delete');
        });
    });


// add to Checkout/payment button
    Route::group(['namespace' => 'App\Http\Controllers'], function(){
        Route::group(['prefix' => 'payment'], function(){
            Route::get('/','PaymentController@index')->name('payment.index');
            Route::post('/store','PaymentController@store')->name('payment.store');
        });
    });



// ===========>> Api Routes <<==============

    // Route::get('/get-districts/{id}', function($id){
    //     return App\Models\District::where('division_id', $id)->get();
    // });