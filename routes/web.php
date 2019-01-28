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

//Route::get('/{link}', 'HomeController@index');




// First route that user visits on consumer app
Route::get('/redirect', function () {
    // Build the query parameter string to pass auth information to our request
    $query = http_build_query([
        'client_id' => 3,
        'redirect_uri' => 'http://192.168.10.23:8880/oauth/callback',
        'response_type' => 'code',
        'scope' => 'conference'
    ]);

    // Redirect the user to the OAuth authorization page
    return redirect('http://192.168.10.23:8880/oauth/authorize?' . $query);
});

// Route that user is forwarded back to after approving on server
Route::get('/oauth/callback', function (Request $request) {
    $http = new GuzzleHttp\Client;

    $response = $http->post('http://192.168.10.23:8880/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => 3, // from admin panel above
            'client_secret' => 'yxOJrP0L9gqbXxoxoFl5I22IytFOpeCnUXD3aE0d', // from admin panel above
            'redirect_uri' => 'http://192.168.10.23:8880/callback',
            'code' => $request->code // Get code from the callback
        ]
    ]);

    // echo the access token; normally we would save this in the DB
    return json_decode((string) $response->getBody(), true)['access_token'];
});