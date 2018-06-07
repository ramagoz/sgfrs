<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/sin_rol', function()
{
    return view('error');
});

Route::group(['middleware' => 'auth'], function() 
{

	Route::get('rrhh', 'RrhhControlador@getIndex');

	Route::get('oficial', 'OficialControlador@getIndex');

	Route::get('empleado', 'EmpleadoControlador@getIndex');

	Route::get('empresa', 'EmpresaControlador@getIndex');

});




