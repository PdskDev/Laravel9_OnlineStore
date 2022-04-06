<?php

use App\Http\Controllers\HomeController;
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

