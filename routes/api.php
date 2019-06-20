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
Route::get('/makers/{year}/{make}', 'CarController@getModels');
Route::get('/makers/{year}/{make}/{model}', 'CarController@getTrims');
Route::get('/makers/{year}/{make}/{model}/{trim}', 'CarController@calculateVinyl');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
