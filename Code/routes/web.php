<?php
    
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
    Route::get('/','App\Http\Controllers\AdminController@index')->name('home');
    Auth::routes();
    
    Route::get('/orders','App\Http\Controllers\OrderController@index')->name('order-index');
    Route::get('/create','App\Http\Controllers\OrderController@create')->name('order-create');
    Route::post('/create','App\Http\Controllers\OrderController@store')->name('order-store');
    Route::get('/show/{id}','App\Http\Controllers\OrderController@show')->name('order-show');
    Route::get('/edit/{id}','App\Http\Controllers\OrderController@edit')->name('order-edit');
    Route::post('/edit/{id}','App\Http\Controllers\OrderController@update')->name('order-update');
    Route::delete('/delete/{id}','App\Http\Controllers\OrderController@destroy')->name('order-destroy');
    Route::get('/export', 'App\Http\Controllers\OrderController@export')->name('order-export');
    
    
    
    