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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('addlocation', 'LocationController@index');

Route::post('addlocation', 'LocationController@store');
Route::get('locationlists', 'LocationController@lists');
Route::get('editlocation/{id}', 'LocationController@edit');
Route::post('updatelocation/{id}', 'LocationController@update');
Route::get('dellocation/{id}', 'LocationController@destroy');

//chat

Route::get('chat', 'chatcontroller@index');
Route::get('chat/{id}', 'chatcontroller@create');
Route::post('chat/chat', 'chatcontroller@store');