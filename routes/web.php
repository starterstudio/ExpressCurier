<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('frontpage'); });
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::post('/info-reload', 'DPDController@CalculateChange');
Route::post('/get-localities', 'DPDController@GetLocalities');
Route::post('/send', 'DPDController@SaveUserInfo');

Route::post('/pay', 'NetopiaController@SendPayment');
//Route::post('/ipn', 'IPNController@index');
//Route::post('/success', 'IPNController@index');

