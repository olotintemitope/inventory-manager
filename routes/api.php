<?php

// use Illuminate\Http\Request;


// |--------------------------------------------------------------------------
// | API Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register API routes for your application. These
// | routes are loaded by the RouteServiceProvider within a group which
// | is assigned the "api" middleware group. Enjoy building your API!
// |


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

$api = app('api.router');//app('Dingo\Api\Routing\Router');

$authParams = [
    'as' => 'api::',
    'version' => 'v1',
    'domain' => env('APP_URL'), // Notice we use the domain WITHOUT port number
    'namespace' => 'App\\Http\\Controllers',
    'middleware' => 'api.auth',
];
$params = [
    'as' => 'api::',
    'version' => 'v1',
    'domain' => env('APP_URL'), // Notice we use the domain WITHOUT port number
    'namespace' => 'App\\Http\\Controllers',
];

$api->group($params, function($api) {
    $api->post('users', 'UserController@store');
    $api->post('authenticate', 'AuthenticateController@authenticate');
});

$api->group($authParams, function($api) {
	$api->get('users', 'UserController@getAll');
	$api->get('users/{id}', 'UserController@getUser');
	$api->put('users/{id}', 'UserController@updateUser');
    // Create business endpoints
    $api->post('businesses', 'BusinessController@store');
    $api->get('businesses', 'BusinessController@getAll');
    $api->get('businesses/{id}', 'BusinessController@getBusiness');
    $api->put('users/{userId}/businesses/{id}', 'BusinessController@updateBusiness');
    // Authentication
	$api->post('logout', 'AuthenticateController@logout');
	$api->get('token', 'AuthenticateController@getToken');
});


