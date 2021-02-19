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

Route::get('user-registration', 'UserController@index');

Route::post('user-store', 'UserController@userPostRegistration');

Route::get('user-login', 'UserController@userLoginIndex');

Route::post('login', 'UserController@userPostLogin');

Route::get('dashboard', 'myAccount@dashboard')->name('dashboard');

Route::get('logout', 'myAccount@logout');

Route::get('contact-registration', 'myAccount@create');

Route::post('user-contact-store', 'myAccount@addContactDetails');

Route::get('search/', 'myAccount@search')->name('search');

Route::get('users', ['uses'=>'myAccount@index1', 'as'=>'users.index']);

Route::get('update/{id}','myAccount@show');
Route::post('update/{id}','myAccount@update')->name('update.registration'); 

Route::get('delete-records','myAccount@delete');
Route::get('delete/{id}','myAccount@destroy'); 

Route::get('disable-records','myAccount@disable-records');
Route::get('disable/{id}','myAccount@disable'); 

