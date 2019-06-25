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
    $cars = \App\Cars::all();
    return view('allcars' ,compact('cars'));
});
Route::get('/cars','CarController@allcars');

Route::post('/cars','CarController@newcar')->name('car');
Route::get('review/{car}','ReviewsController@review')->name('getreview');
Route::get('review','ReviewsController@store')->name('review.store');
Route::get('allrevies','ReviewsController@allreviews')->name('allreviews');
Route::get('car/{review}','ReviewsController@car')->name('getcar');
