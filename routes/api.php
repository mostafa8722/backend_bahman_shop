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


Route::group(
    [
        'prefix'=>'v1/admin',
        'namespace'=>'App\Http\Controllers\Api\v1\admin',
        'middleware' => ['auth-admin']
    ],
    function(){

       
   Route::get('products','ProductController@index');
   Route::post('products','ProductController@create');
   Route::put('products','ProductController@update');
   Route::get('products/{product}','ProductController@single');
   Route::delete('products/{product}','ProductController@delete');
    

   
   Route::get('categories','CategoryController@index');
   Route::post('categories','CategoryController@create');
   Route::put('categories/{category}','CategoryController@update');
   Route::get('categories/{category}','CategoryController@single');
   Route::delete('categories/{category}','CategoryController@delete');
   
   Route::get('colors','ColorController@index');
   Route::post('colors','ColorController@create');
   Route::put('colors/{color}','ColorController@update');
   Route::get('colors/{color}','ColorController@single');
   Route::delete('colors/{color}','ColorController@delete');
    


    

   Route::get('roles','RoleController@index');
   Route::post('roles','RoleController@create');
   Route::put('roles/{role}','RoleController@update');
   Route::get('roles/{role}','RoleController@single');
   Route::delete('roles/{role}','RoleController@delete');
    
   Route::get('permissions','PermissionController@index');
   Route::post('permissions','PermissionController@create');
   Route::put('permissions/{permission}','PermissionController@update');
   Route::get('permissions/{permission}','PermissionController@single');
   Route::delete('permissions/{permission}','PermissionController@delete');


    

   Route::get('sizes','SizeController@index');
   Route::post('sizes','SizeController@create');
   Route::put('sizes/{size}','SizeController@update');
   Route::get('sizes/{size}','SizeController@single');
   Route::delete('sizes/{size}','SizeController@delete');


   
   Route::get('specifications','SpecificationController@index');
   Route::post('specifications','SpecificationController@create');
   Route::put('specifications/{specification}','SpecificationController@update');
   Route::get('specifications/{specification}','SpecificationController@single');
   Route::delete('specifications/{specification}','SpecificationController@delete');

   

   Route::get('users','UserController@index');
   Route::post('users','UserController@create');
   Route::put('users/{user}','UserController@update');
   Route::get('users/{user}','UserController@single');
   Route::delete('users/{user}','UserController@delete');

    }
);
Route::group(['prefix'=>'v1','namespace'=>'App\Http\Controllers\Api\v1'],function () {
  

    Route::post('login','UserController@login');

     
 });

