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

	Route::get('rrhh', 'RrhhControlador@getIndexRrhh');

	Route::get('oficial', 'OficialControlador@getIndexOficial');

	Route::get('empleado', 'EmpleadoControlador@getIndexEmpleado');

	Route::get('empresa', 'EmpresaControlador@getIndexEmpresa');

});




