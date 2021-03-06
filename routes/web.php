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

Route::get('/', function () {
    return view('welcome');
})->name("main");

Route::get("/temp", "TemperatureController@index")->name("temp");
Route::get("/orders", "OrdersController@index")->name("orders");
Route::get("/orders/{id}", "OrdersController@show")->name("edit-order");
Route::put("/orders/{id}", "OrdersController@update")->name("update-order");
