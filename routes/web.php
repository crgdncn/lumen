<?php
use Illuminate\Support\Facades\Route;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


Route::get('/', function () use ($router) {
    return $router->app->version();
});


Route::get('/cities', ['as' => 'city.index', 'uses' => 'CityController@index']);
Route::get('/cities/{city}', ['as' => 'city.show', 'uses' => 'CityController@show']);
Route::post('/cities', ['as' => 'city.create', 'uses' => 'CityController@store']);
Route::put('/cities/{city}', ['as' => 'city.update', 'uses' => 'CityController@update']);
Route::patch('/cities/{id}', ['as' => 'city.restore', 'uses' => 'CityController@restore']);
Route::delete('/cities/{city}', ['as' => 'city.delete', 'uses' => 'CityController@destroy']);


