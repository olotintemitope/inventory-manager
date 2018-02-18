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

$api = app('Dingo\Api\Routing\Router');

$params = [
    'as' => 'api::',
    'version' => 'v1',
    'domain' => env('APP_URL'), // Notice we use the domain WITHOUT port number
    'namespace' => 'App\\Http\\Controllers',
];

$api->group($params, function($api) {
    $api->get('users', 'UserController@show');
});


