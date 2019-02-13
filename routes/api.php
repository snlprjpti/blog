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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//
Route::apiResource('user','API\UserController');

//Route::middleware('auth:api')->get('user','API\UserController@index');
//
Route::apiResource('blogs','API\BlogController');

Route::post('registerFromMBL','API\HomeController@register');

Route::get('register/activate/{token}','API\HomeController@registerActivate');

Route::post('loginFromMBL','API\HomeController@login');


Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@store');
Route::group(['middleware' => 'auth:api'], function(){
    Route::get('details', 'API\UserController@details');
});

Route::group(['middleware' => 'auth.jwt'], function () {

    Route::get('logout', 'API\ApiController@logout');


    Route::resource('products', 'ProductController');
});

Route::post('loginJWT', 'API\ApiController@login');
Route::post('registerJWT', 'API\ApiController@register');



//
//Route::get('/user', function (){
//    $http = new GuzzleHttp\Client;
//
//    $response = $http->post(url('/oauth/token'), [
//        'form_params' => [
//            'grant_type' => 'authorization_code',
//            'client_id' => env('API_CLIENT_ID'),
//            'client_secret' => env('API_CLIENT_SECRET'),
//            'code' => request()->code,
//        ],
//    ]);
//    $apiResponse = json_decode((string) $response->getBody(), true);
//    session(['api'=> $apiResponse]);
//    session(['api-token'=> $apiResponse['access_token']]);
//});