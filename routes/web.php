<?php
use Illuminate\Http\Request;

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

Auth::routes(['verify' => true]);

Route::get('/dashboard', 'HomeController@index')->name('home');


Route::get('/callback', function (Request $request) {

    $http = new GuzzleHttp\Client;
    $response = $http->post('localhost:5554/oauth/token', [
        'form_params' => [
            'grant_type' => 'password',
            'client_id' => '2', // from admin panel above
            'client_secret' => 'jWXLtR5WWgKl02LF5xIy0EnvhOwukjogjg3sBKls', // from admin panel above
//            'redirect_uri' => 'http://127.0.0.1:8001/dashboard',
            'username' => 'sunil@youngminds.com.np',
            'password' => 'sunil',
            'scope' => ''
//                    'code' => $request->code,
        ],
    ]);
    dd($response);
    return json_decode((string) $response->getBody(), true);
});

Route::get('/faces', 'HomeController@facejs');
Route::get('/faces/details', 'HomeController@faceDetails');
