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

Route::get('/products', 'App\Http\Controllers\ProductsController@index')->name('products.index');
Route::get('/products/{id}', 'App\Http\Controllers\ProductsController@show')->name('products.show');
