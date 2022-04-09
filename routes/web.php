<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StripePaymentController;

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

//Route::get('/', function () {
    //$viewData = [];
    //$viewData['title']= "Prestadesk - Online Store";
    //return view('home.index')->with('viewData', $viewData);
//});

//Route::get('/', [HomeController::class, 'index'])->name('home.index');
//Route::get('/about', [HomeController::class, 'about'])->name('home.about');

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');
Route::get('/about', 'App\Http\Controllers\HomeController@about')->name('home.about');

Route::get('/products/list', 'App\Http\Controllers\ProductsController@index')->name('products.index');
Route::get('/products/show/{id}', 'App\Http\Controllers\ProductsController@show')->name('products.show');

Route::get('/cart', 'App\Http\Controllers\CartController@index')->name('cart.index');
Route::get('/cart/delete', 'App\Http\Controllers\CartController@delete')->name('cart.delete');
Route::put('/cart/add/{id}', 'App\Http\Controllers\CartController@add')->name('cart.add');

//Route::get('/checkout', 'App\Http\Controllers\PaymentController​@checkout')->name('payment.checkout');
//Route::post('/checkout', 'App\Http\Controllers\PaymentController@checkout')->name('payment.checkout');

Route::get('/checkout', 'App\Http\Controllers\StripePaymentController@stripe')->name('stripe.checkout');
Route::post('/checkout', 'App\Http\Controllers\StripePaymentController@stripe')->name('stripe.checkout');
Route::post('/payment', 'App\Http\Controllers\StripePaymentController@stripePost')->name('stripe.payment');
Route::get('/payment', 'App\Http\Controllers\StripePaymentController@stripePost')->name('stripe.payment');

Route::middleware('auth')->group(function() {
    Route::get('cart/purchase', 'App\Http\Controllers\CartController@purchase')->name('cart.purchase');
    Route::get('/my-account/orders', 'App\Http\Controllers\MyAccountController@orders')->name('myaccount.orders');
});

Route::middleware('admin')->group(function(){
Route::get('/admin', 'App\Http\Controllers\Admin\AdminHomeController@index')->name('admin.home.index');
Route::get('/admin/products', 'App\Http\Controllers\Admin\AdminProductController@index')->name('admin.product.index');
Route::post('/admin/products/store', 'App\Http\Controllers\Admin\AdminProductController@store')->name('admin.product.store');
Route::delete('/admin/products/delete/{id}', 'App\Http\Controllers\Admin\AdminProductController@delete')->name('admin.product.delete');
Route::get('/admin/products/edit/{id}', 'App\Http\Controllers\Admin\AdminProductController@edit')->name('admin.product.edit');
Route::put('/admin/products/update/{id}', 'App\Http\Controllers\Admin\AdminProductController@update')->name('admin.product.update');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



