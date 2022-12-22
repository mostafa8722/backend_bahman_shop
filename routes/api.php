<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
example-1| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix'=>'v1','namespace'=>'App\Http\Controllers\Api\v1'],function () {
  

    Route::post('login','UserController@login');

     
 });
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
