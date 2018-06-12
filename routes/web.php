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
//Sección rutas empresa----------------------------------------------
	Route::get('empresa', 'EmpresaControlador@getIndexEmpresa');
	Route::get('empresa/alta_oficial', 'EmpresaControlador@getAltaOficial');
	Route::get('empresa/baja_oficial', 'EmpresaControlador@getBajaOficial');
	Route::get('empresa/modificacion_oficial', 'EmpresaControlador@getModificacionOficial');
	Route::get('empresa/busqueda_oficial', 'EmpresaControlador@getBusquedaOficial');
	Route::get('empresa/recibos_pendientes_empresa', 'EmpresaControlador@getRecibosPendientesEmpresa');
	Route::get('empresa/recibos_pendientes_empleados', 'EmpresaControlador@getRecibosPendientesEmpleados');
	Route::get('empresa/recibos_firmados_empresa', 'EmpresaControlador@getRecibosFirmadosEmpresa');
	Route::get('empresa/informes_empresa', 'EmpresaControlador@getInformesEmpresa');
	Route::get('empresa/cambiar_contraseña', 'EmpresaControlador@getCambiarContraseña');

//Sección rutas rrhh----------------------------------------------

	Route::get('rrhh', 'RrhhControlador@getIndexRrhh');
	Route::get('rrhh/alta_empleado', 'RrhhControlador@getAltaEmpleado');
	Route::get('rrhh/baja_empleado', 'RrhhControlador@getBajaEmpleado');
	Route::get('rrhh/modificacion_empleado', 'RrhhControlador@getModificacionEmpleado');
	Route::get('rrhh/busqueda_empleado', 'RrhhControlador@getBusquedaEmpleado');
	Route::get('rrhh/crear_nuevo_periodo', 'RrhhControlador@getCrearNuevoPeriodo');
	Route::get('rrhh/validar_recibos', 'RrhhControlador@getValidarRecibos');
	Route::get('rrhh/importar_recibos', 'RrhhControlador@getImportarRecibos');
	Route::get('rrhh/empleados_sin_recibos', 'RrhhControlador@getEmpleadosSinRecibos');
	Route::get('rrhh/corregir_recibos', 'RrhhControlador@getCorregirRecibos');
	Route::get('rrhh/grupos_recibos', 'RrhhControlador@getGruposRecibos');
	Route::get('rrhh/pendientes_firma_empresa', 'RrhhControlador@getPendientesFirmaEmpresa');
	Route::get('rrhh/pendientes_firma_empleados', 'RrhhControlador@getPendientesFirmaEmpleados');
	Route::get('rrhh/firmados_empresa_empleados', 'RrhhControlador@getFirmadosEmpresaEmpleados');
	Route::get('rrhh/todos_los_recibos', 'RrhhControlador@getTodosLosRecibos');
	Route::get('rrhh/informes_rrhh', 'RrhhControlador@getInformesRrhh');
	Route::get('rrhh/cambiar_contraseña', 'RrhhControlador@getCambiarContraseña');

	

//Sección rutas oficial----------------------------------------------

	Route::get('oficial', 'OficialControlador@getIndexOficial');
	Route::get('oficial/alta_rrhh', 'OficialControlador@getAltaRrhh');
	Route::get('oficial/baja_rrhh', 'OficialControlador@getBajaRrhh');
	Route::get('oficial/modificacion_rrhh', 'OficialControlador@getModificacionRrhh');
	Route::get('oficial/busqueda_rrhh', 'OficialControlador@getBusquedaRrhh');
	Route::get('oficial/alta_empresa', 'OficialControlador@getAltaEmpresa');
	Route::get('oficial/baja_empresa', 'OficialControlador@getBajaEmpresa');
	Route::get('oficial/modificacion_empresa', 'OficialControlador@getModificacionEmpresa');
	Route::get('oficial/busqueda_empresa', 'OficialControlador@getBusquedaEmpresa');
	Route::get('oficial/roles', 'OficialControlador@getRoles');
	Route::get('oficial/auditoria', 'OficialControlador@getAuditoria');
	Route::get('oficial/restablecer_contraseña', 'OficialControlador@getRestablecerContraseña');
	Route::get('oficial/cambiar_contraseña', 'OficialControlador@getCambiarContraseña');

//Sección rutas empleado----------------------------------------------

	Route::get('empleado', 'EmpleadoControlador@getIndexEmpleado');
	Route::get('empleado/recibos_pendientes', 'EmpleadoControlador@getRecibosPendientes');
	Route::get('empleado/recibos_firmados', 'EmpleadoControlador@getRecibosFirmados');
	Route::get('empleado/contactar_rrhh', 'EmpleadoControlador@getContactarRrhh');
	Route::get('empleado/cambiar_contraseña', 'EmpleadoControlador@getCambiarContraseña');

});




