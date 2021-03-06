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

// Form listar electores
Route::get( '/formlistarelectors', array(
    'as' => 'formlistarelectors',
    'uses' => 'ElectorsController@listarshow'
) );

// Form listar electores
Route::post( '/showlistarelectors', array(
    'as' => 'showlistarelectors',
    'uses' => 'ElectorsController@listarshow'
) );

// Editar Elector
Route::get( '/electors/{id}/{name?}/edit', array(
    'as' => 'electors.edit',
    'uses' => 'ElectorsController@edit'
) );

// Editar Elector
Route::get( '/electors', array(
    'as' => 'electors.index',
    'uses' => 'ElectorsController@index'
) );



// Route::resource('electors', 'ElectorsController');

// Ciudads
Route::post( '/electors/buscar', array(
    'as' => 'electors.buscar',
    'uses' => 'ElectorsController@buscar'
) );

// Grabar barrio
Route::post( '/electors/grabarelector', array(
    'as' => 'electors.grabarelector',
    'uses' => 'ElectorsController@grabarelector'
) );




// Grabar barrio
Route::get( '/electoresporbarrios', array(
    'as' => 'electors.electoresporbarrios',
    'uses' => 'ElectorsController@electoresporbarrios'
) );


// Grabar barrio
Route::get( '/electoresporpunteros', array(
    'as' => 'electors.electoresporpunteros',
    'uses' => 'ElectorsController@electoresporpunteros'
) );


// Grabar barrio
Route::get( '/electorespormesa', array(
    'as' => 'electors.electorespormesa',
    'uses' => 'ElectorsController@electorespormesa'
) );
// Grabar barrio
Route::post( '/electors/showelectorsmesa', array(
    'as' => 'electors.showelectorsmesa',
    'uses' => 'ElectorsController@showelectorsmesa'
) );



// Editar Elector
Route::get( '/electors/{id}/{tabla?}/{opcion}', array(
    'as' => 'electors.informevotantes',
    'uses' => 'ElectorsController@informevotantes'
) );

// Editar Elector
Route::get( '/electors/{id}/voto', array(
    'as' => 'electors.voto',
    'uses' => 'ElectorsController@voto'
) );



Route::get('importarpadron','ElectorsController@importarpadron');



// Editar Elector
Route::get( '/votos/{codigo}/{mesa}/{orden}/{tvoto}', array(
    'as' => 'votos.store',
    'uses' => 'VotosController@store'
) );


// Editar Elector
Route::get( '/servicejson/{tabla}/{id}', array(
    'as' => 'electors.servicejson',
    'uses' => 'ElectorsController@servicejson'
) );
