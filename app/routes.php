<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', ['as' => 'home', function () {

	return View::make('hello');

}]);


Route::get('profile', function() {

	return "Bienvenido " . Auth::user()->email;

})->before('auth');

Route::get('login','SessionsController@create');

Route::get('logout','SessionsController@destroy');

Route::resource('sessions', 'SessionsController' , ['only' => ['index', 'create', 'destroy', 'store']]);

Route::resource('users', 'UsersController');


// Ciudads
Route::get( '/barrios/search', array(
    'as' => 'barrios.search',
    'uses' => 'BarriosController@search'
) );
Route::resource('barrios', 'BarriosController');

Route::resource('electors', 'ElectorsController');

// Ciudads
Route::post( '/electors/buscar', array(
    'as' => 'electors.buscar',
    'uses' => 'ElectorsController@buscar'
) );

// Ciudads
Route::post( '/electors/grabarbarrio', array(
    'as' => 'electors.grabarbarrio',
    'uses' => 'ElectorsController@grabarbarrio'
) );


Route::get('importarpadron','ElectorsController@importarpadron');
