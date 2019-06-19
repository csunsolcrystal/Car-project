<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/years', 'CarController@getYears');
Route::get('/makers/{year}', 'CarController@getMakers');
Route::get('/makers/{year}/{model}', 'CarController@getModels');
Route::get('/makers/{year}/{model}/{trim}', 'CarController@getTrims');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
