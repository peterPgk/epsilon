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
//
//Route::get('/', function () {
////    dump(auth()->user());
////    dump(session()->get('token'));
//    return view('welcome');
//});

//Route::get('/login', 'Auth\LoginController@showLoginForm')->middleware(['web', 'auth'])->name('login');
//Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
//Route::post('/login', 'AuthController@login');

Auth::routes(['register' => false]);


Route::get('/{any}', 'ServicesController@index')->where('any', '.*');
