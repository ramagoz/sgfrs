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
//Salir del Sistema
	Route::get('/salir','HomeController@getSalirSistema');

//Sección de rol----------------------------------------------
	Route::post('auth/rol_seleccionado', 'HomeController@postRolSeleccionado');
//Sección rutas empresa----------------------------------------------
	Route::get('empresa', 'EmpresaControlador@getIndexEmpresa');
	Route::get('empresa/inicio', 'EmpresaControlador@getRecibosPendientesEmpresa');

	Route::get('empresa/busqueda_oficial', 'EmpresaControlador@getBusquedaOficial')->name('empresa/busqueda_oficial');

	Route::get('empresa/alta_oficial', 'EmpresaControlador@getAltaOficial');
	Route::post('empresa/oficial_cargado', 'EmpresaControlador@postOficialCargado');

	Route::get('empresa/modificacion_oficial/{cedula}', 'EmpresaControlador@getModificacionOficial');
	Route::post('empresa/oficial_modificado', 'EmpresaControlador@postOficialModificado');

	Route::get('empresa/recibos_pendientes_empresa', 'EmpresaControlador@getRecibosPendientesEmpresa')->name('empresa/recibos_pendientes_empresa');
	Route::get('empresa/ver_recibo_pendiente_firma_empresa/{id}', 'EmpresaControlador@getVerRecibo');
	Route::get('empresa/recibos_pendientes_empleados', 'EmpresaControlador@getRecibosPendientesEmpleados')->name('empresa/recibos_pendientes_empleados');

	Route::post('empresa/firmar_recibo_empresa/', 'EmpresaControlador@postFirmarReciboPendienteEmpresa');
	Route::post('empresa/firma_masiva_empresa', 'EmpresaControlador@postFirmaMasivaRecibosPendientesEmpresa');

	Route::get('empresa/ver_recibo_pendiente_firma_empleado/{id}', 'EmpresaControlador@getVerReciboPendienteFirmaEmpleado');
	Route::get('empresa/recibos_firmados_empresa_empleados', 'EmpresaControlador@getRecibosFirmadosEmpresaEmpleados')->name('empresa/recibos_firmados_empresa_empleados');
	Route::get('empresa/ver_recibo_firmado_empresa_empleado/{id}', 'EmpresaControlador@getVerReciboFirmadoEmpresaEmpleado');

	Route::get('empresa/informes_empresa', 'EmpresaControlador@getInformesEmpresa')->name('empresa/informes_empresa');
	Route::post('empresa/resultado_informes_empresa', 'EmpresaControlador@postVerInformesEmpresa');
	Route::get('empresa/pdf/{id}', 'RrhhControlador@getPdf');

	Route::get('empresa/cambiar_contraseña', 'EmpresaControlador@getCambiarContraseña')->name('empresa/cambiar_contraseña');
	Route::post('empresa/update_password', 'EmpresaControlador@postUpdatePassword');

	Route::get('empresa/datatable', 'EmpresaControlador@datatable');


//Sección rutas rrhh----------------------------------------------

	Route::get('rrhh', 'RrhhControlador@getIndexRrhh');
	Route::get('rrhh/datatable', 'RrhhControlador@datatable');
	//Modulo de ABM empleados
	Route::get('rrhh/busqueda_empleado', 'RrhhControlador@getBusquedaEmpleado')->name('rrhh/busqueda_empleado');
	//Modulo de alta de empleado
	Route::get('rrhh/alta_empleado', 'RrhhControlador@getAltaEmpleado');
	Route::post('rrhh/empleado_cargado', 'RrhhControlador@postEmpleadoCargado');

	//Modulo de actualizacion de datos del empleado
	Route::get('rrhh/modificacion_empleado/{cedula}', 'RrhhControlador@getModificacionEmpleado');
	Route::post('rrhh/empleado_modificado', 'RrhhControlador@postEmpleadoModificado');


	Route::get('rrhh/crear_nuevo_periodo', 'RrhhControlador@getCrearNuevoPeriodo');
	Route::post('rrhh/crear_nuevo_periodo', 'RrhhControlador@getCrear');

	Route::get('rrhh/validar_recibos', 'RrhhControlador@getValidarRecibos');
	Route::post('rrhh/validar_recibos', 'RrhhControlador@postValidarRecibos');

	Route::get('rrhh/importar_recibos', 'RrhhControlador@getImportarRecibos');
	Route::post('rrhh/importar_recibos', 'RrhhControlador@getRecibosImportados');

	Route::get('rrhh/empleados_sin_recibos', 'RrhhControlador@getEmpleadosSinRecibos');
	Route::get('rrhh/excel', 'RrhhControlador@getExcel');
	Route::get('rrhh/ver_empleados_sin_recibos/{id}','RrhhControlador@getVerEmpleadosSinRecibos');

	Route::get('rrhh/lista_recibos', 'RrhhControlador@getListaRecibos');
	Route::get('rrhh/ver_recibo_a_corregir/{id}', 'RrhhControlador@getVerReciboACorregir');
	Route::post('rrhh/lista_recibos', 'RrhhControlador@postCorregirRecibo');
	Route::get('rrhh/historial_recibos_corregidos', 'RrhhControlador@getVerHistorial');
	Route::get('rrhh/ver_recibo_corregido/{id}', 'RrhhControlador@getVerReciboCorregido');

	Route::get('rrhh/pendientes_firma_empresa', 'RrhhControlador@getPendientesFirmaEmpresa');
	Route::get('rrhh/ver_recibo/{id}', 'RrhhControlador@getVerRecibo');


	Route::get('rrhh/pendientes_firma_empleados', 'RrhhControlador@getPendientesFirmaEmpleados');
	Route::get('rrhh/ver_recibo_pendientes_firma_empleados/{id}', 'RrhhControlador@getVerReciboPendientesFirmaEmpleados');

	Route::get('rrhh/firmados_empresa_empleados', 'RrhhControlador@getFirmadosEmpresaEmpleados');
	Route::get('rrhh/ver_recibo_firmado_empresa_empleado/{id}', 'RrhhControlador@getVerReciboFirmadoEmpresaEmpleado');
	Route::get('rrhh/todos_los_recibos', 'RrhhControlador@getTodosLosRecibos');
	Route::get('rrhh/ver_todos_los_recibos/{id}', 'RrhhControlador@getVerTodosLosRecibos');

	Route::get('rrhh/informes_rrhh', 'RrhhControlador@getInformesRrhh')->name('rrhh/informes_rrhh');
	Route::post('rrhh/resultado_informes_rrhh', 'RrhhControlador@postVerInformesRrhh');
	Route::get('rrhh/pdf/{id}', 'RrhhControlador@getPdf');

	Route::get('rrhh/contactar_rrhh', 'RrhhControlador@getContactarRrhh');
	Route::get('rrhh/cambiar_contraseña', 'RrhhControlador@getCambiarContraseña')->name('rrhh/cambiar_contraseña');
	Route::post('rrhh/update_password', 'RrhhControlador@postUpdatePassword');



//Sección rutas oficial----------------------------------------------

	Route::get('oficial', 'OficialControlador@getIndexOficial');

	//Funciones para obtencion de datos para los datatables
	Route::get('oficial/datatable', 'OficialControlador@datatable');
	Route::get('oficial/datatableempresa', 'OficialControlador@datatableempresa');
	Route::get('oficial/datatablerol', 'OficialControlador@datatablerol');

	//Modulo de listado de usuario de RRHH
	Route::get('oficial/busqueda_rrhh', 'OficialControlador@getBusquedaRrhh')->name('oficial/busqueda_rrhh');
	Route::get('oficial/busqueda_empresa', 'OficialControlador@getBusquedaEmpresa')->name('oficial/busqueda_empresa');

	//Alta de nuevos usuarios
	Route::get('oficial/alta_empresa', 'OficialControlador@getAltaEmpresa');
	Route::get('oficial/alta_rrhh', 'OficialControlador@getAltaRrhh');

	Route::post('oficial/rrhh_cargado', 'OficialControlador@postRrhhCargado');
	Route::post('oficial/empresa_cargado', 'OficialControlador@postEmpresaCargado');

	//Actualizacion de datos de usuarios existentes
	Route::get('oficial/modificacion_rrhh/{cedula}', 'OficialControlador@getModificacionRrhh');
	Route::get('oficial/modificacion_empresa/{cedula}', 'OficialControlador@getModificacionEmpresa');

	Route::post('oficial/rrhh_modificado', 'OficialControlador@postRrhhModificado');
	Route::post('oficial/empresa_modificado', 'OficialControlador@postEmpresaModificado');

	//Modificacion de roles de usuarios
	Route::get('oficial/roles', 'OficialControlador@getRoles')->name('oficial/roles');
	Route::get('oficial/modificacion_rol/{cedula}', 'OficialControlador@getModificacionRol');
	Route::get('oficial/rol_modificado', 'OficialControlador@getRolModificado');

	//Modulo de listado de registros de auditoria
	Route::get('oficial/auditoria', 'OficialControlador@getAuditoria')->name('oficial/auditoria');
	Route::get('oficial/datatableauditoria', 'OficialControlador@getDatatableAuditoria');

	//Modulo de cambio de contraseña del usuario
	Route::get('oficial/cambiar_contraseña', 'OficialControlador@getCambiarContraseña')->name('oficial/cambiar_contraseña');
	Route::post('oficial/update_password', 'OficialControlador@postUpdatePassword');

	//Modulo para restablecer acceso de usuarios
	Route::get('oficial/restablecer_contraseña', 'OficialControlador@getRestablecerContraseña');


//Sección rutas empleado----------------------------------------------

	Route::get('empleado', 'EmpleadoControlador@getIndexEmpleado');

	Route::get('empleado/recibos_pendientes', 'EmpleadoControlador@getRecibosPendientes')->name('empleado/recibos_pendientes');
	Route::get('empleado/ver_recibo_pendiente_firma_empleado/{id}', 'EmpleadoControlador@getVerReciboPendienteFirmaEmpleado');

	Route::post('empleado/firmar_recibo','EmpleadoControlador@postFirmarRecibo');
	Route::post('empleado/firma_recibos', 'EmpleadoControlador@postFirmaMasiva');

	Route::get('empleado/recibos_firmados', 'EmpleadoControlador@getRecibosFirmados')->name('empleado/recibos_firmados');

	Route::get('empleado/ver_recibo_firmado_empleado/{id}', 'EmpleadoControlador@getVerReciboFirmadoEmpresaEmpleado');

	Route::get('empleado/cambiar_contraseña', 'EmpleadoControlador@getCambiarContraseña')->name('empleado/cambiar_contraseña');
	Route::post('empleado/update_password', 'EmpleadoControlador@postUpdatePassword');

	Route::get('empleado/contactar_rrhh', 'EmpleadoControlador@getContactarRrhh')->name('empleado/contactar_rrhh');


});




