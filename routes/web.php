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
	Route::get('empresa/inicio', 'EmpresaControlador@getIndexEmpresa');
	Route::get('empresa', 'EmpresaControlador@getRecibosPendientesEmpresa');
	Route::get('empresa/alta_oficial', 'EmpresaControlador@getAltaOficial');
	Route::post('empresa/oficial_cargado', 'EmpresaControlador@postOficialCargado');
	Route::get('empresa/desactivar_oficial/{cedula}', 'EmpresaControlador@getRecuperarGrupo');
	Route::get('empresa/activar_oficial/{cedula}', 'EmpresaControlador@getRecuperarGrupo');
	Route::get('empresa/oficial_desactivar', 'EmpresaControlador@getOficialDesactivado');
	Route::get('empresa/oficial_activar', 'EmpresaControlador@getOficialActivado');
	Route::get('empresa/modificacion_oficial/{cedula}', 'EmpresaControlador@getModificacionOficial');
	Route::get('empresa/oficial_modificado', 'EmpresaControlador@getOficialModificado');
	Route::get('empresa/busqueda_oficial', 'EmpresaControlador@getBusquedaOficial');

	Route::get('empresa/recibos_pendientes_empresa', 'EmpresaControlador@getRecibosPendientesEmpresa');
	Route::get('empresa/ver_recibo_pendiente_firma_empresa/{id}', 'EmpresaControlador@getVerRecibo');
	Route::get('empresa/recibos_pendientes_empleados', 'EmpresaControlador@getRecibosPendientesEmpleados');

	Route::post('empresa/firmar_recibo_empresa/', 'EmpresaControlador@postFirmarReciboPendienteEmpresa');
	Route::post('empresa/firma_masiva_empresa', 'EmpresaControlador@postFirmaMasivaRecibosPendientesEmpresa');

	Route::get('empresa/ver_recibo_pendiente_firma_empleado/{id}', 'EmpresaControlador@getVerReciboPendienteFirmaEmpleado');
	Route::get('empresa/recibos_firmados_empresa_empleados', 'EmpresaControlador@getRecibosFirmadosEmpresaEmpleados');
	Route::get('empresa/ver_recibo_firmado_empresa_empleado/{id}', 'EmpresaControlador@getVerReciboFirmadoEmpresaEmpleado');

	Route::get('empresa/informes_empresa', 'EmpresaControlador@getInformesEmpresa');
	Route::post('empresa/resultado_informes_empresa', 'EmpresaControlador@postVerInformesEmpresa');
	Route::get('empresa/pdf/{id}', 'RrhhControlador@getPdf');

	Route::get('empresa/cambiar_contraseña', 'EmpresaControlador@getCambiarContraseña');
	Route::post('empresa/update_password', 'EmpresaControlador@postUpdatePassword');

	Route::get('empresa/datatable', 'EmpresaControlador@datatable');


//Sección rutas rrhh----------------------------------------------

	Route::get('rrhh', 'RrhhControlador@getIndexRrhh');
	Route::get('rrhh/alta_empleado', 'RrhhControlador@getAltaEmpleado');
	Route::post('/rrhh/usuario_creado', 'RrhhControlador@postUsuariocreado');
	Route::post('rrhh/empleado_cargado', 'RrhhControlador@postEmpleadoCargado');
	Route::get('rrhh/desactivar_empleado/{cedula}', 'RrhhControlador@getRecuperarGrupo');
	Route::get('rrhh/activar_empleado/{cedula}', 'RrhhControlador@getRecuperarGrupo');
	Route::get('rrhh/modificacion_empleado/{cedula}', 'RrhhControlador@getModificacionEmpleado');
	Route::get('rrhh/empleado_modificado', 'RrhhControlador@getEmpleadoModificado');
	Route::get('rrhh/empleado_desactivar', 'RrhhControlador@getEmpleadoDesactivado');
	Route::get('rrhh/empleado_activar', 'RrhhControlador@getEmpleadoActivado');
	Route::get('rrhh/busqueda_empleado', 'RrhhControlador@getBusquedaEmpleado');
	Route::get('rrhh/datatable', 'RrhhControlador@datatable');
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

	Route::get('rrhh/grupos_recibos', 'RrhhControlador@getGruposRecibos');
	Route::post('rrhh/grupos_recibos', 'RrhhControlador@postCrearGrupoRecibo');


	Route::get('rrhh/pendientes_firma_empresa', 'RrhhControlador@getPendientesFirmaEmpresa');
	Route::get('rrhh/ver_recibo/{id}', 'RrhhControlador@getVerRecibo');


	Route::get('rrhh/pendientes_firma_empleados', 'RrhhControlador@getPendientesFirmaEmpleados');
	Route::get('rrhh/ver_recibo_pendientes_firma_empleados/{id}', 'RrhhControlador@getVerReciboPendientesFirmaEmpleados');

	Route::get('rrhh/firmados_empresa_empleados', 'RrhhControlador@getFirmadosEmpresaEmpleados');
	Route::get('rrhh/ver_recibo_firmado_empresa_empleado/{id}', 'RrhhControlador@getVerReciboFirmadoEmpresaEmpleado');
	Route::get('rrhh/todos_los_recibos', 'RrhhControlador@getTodosLosRecibos');
	Route::get('rrhh/ver_todos_los_recibos/{id}', 'RrhhControlador@getVerTodosLosRecibos');

	Route::get('rrhh/informes_rrhh', 'RrhhControlador@getInformesRrhh');
	Route::post('rrhh/resultado_informes_rrhh', 'RrhhControlador@postVerInformesRrhh');
	Route::get('rrhh/pdf/{id}', 'RrhhControlador@getPdf');

	Route::get('rrhh/contactar_rrhh', 'RrhhControlador@getContactarRrhh');
	Route::get('rrhh/cambiar_contraseña', 'RrhhControlador@getCambiarContraseña');
	Route::post('rrhh/update_password', 'RrhhControlador@postUpdatePassword');



//Sección rutas oficial----------------------------------------------

	Route::get('oficial', 'OficialControlador@getIndexOficial');
	Route::get('oficial/busqueda_rrhh', 'OficialControlador@getBusquedaRRHH');
	Route::get('oficial/datatable', 'OficialControlador@datatable');
	Route::get('oficial/datatableempresa', 'OficialControlador@datatableempresa');
	Route::get('oficial/datatablerol', 'OficialControlador@datatablerol');
	Route::get('oficial/activar_rrhh/{cedula}', 'OficialControlador@getRecuperarGrupo');
	Route::get('oficial/activar_empresa/{cedula}', 'OficialControlador@getRecuperarGrupoEmpresa');
	Route::get('oficial/modificacion_rrhh/{cedula}', 'OficialControlador@getModificacionRrhh');
	Route::get('oficial/modificacion_empresa/{cedula}', 'OficialControlador@getModificacionEmpresa');
	Route::get('oficial/modificacion_rol/{cedula}', 'OficialControlador@getModificacionRol');
	Route::post('/oficial/usuario_creado', 'OficialControlador@postUsuariocreado');
	Route::post('oficial/rrhh_cargado', 'OficialControlador@postRrhhCargado');
	Route::post('oficial/empresa_cargado', 'OficialControlador@postEmpresaCargado');
	Route::get('oficial/rol_modificado', 'OficialControlador@getRolModificado');
	Route::get('oficial/rrhh_modificado', 'OficialControlador@getRrhhModificado');
	Route::get('oficial/empresa_modificado', 'OficialControlador@getEmpresaModificado');
	Route::get('oficial/desactivar_rrhh/{cedula}', 'OficialControlador@getRecuperarGrupo');
	Route::get('oficial/desactivar_empresa/{cedula}', 'OficialControlador@getRecuperarGrupoEmpresa');
	Route::get('oficial/rrhh_desactivar', 'OficialControlador@getRrhhDesactivado');
	Route::get('oficial/empresa_desactivar', 'OficialControlador@getEmpresaDesactivado');
	Route::get('oficial/rrhh_activar', 'OficialControlador@getRrhhActivado');
	Route::get('oficial/empresa_activar', 'OficialControlador@getEmpresaActivado');
	Route::get('oficial/alta_rrhh', 'OficialControlador@getAltaRrhh');
	Route::get('oficial/baja_rrhh', 'OficialControlador@getBajaRrhh');

	Route::get('oficial/busqueda_rrhh', 'OficialControlador@getBusquedaRrhh');
	Route::get('oficial/alta_empresa', 'OficialControlador@getAltaEmpresa');
	Route::get('oficial/baja_empresa', 'OficialControlador@getBajaEmpresa');
	Route::get('oficial/modificacion_empresa', 'OficialControlador@getModificacionEmpresa');
	Route::get('oficial/busqueda_empresa', 'OficialControlador@getBusquedaEmpresa');
	Route::get('oficial/roles', 'OficialControlador@getRoles');
	Route::get('oficial/auditoria', 'OficialControlador@getAuditoria');
	Route::get('oficial/datatableauditoria', 'OficialControlador@getDatatableAuditoria');
	Route::get('oficial/restablecer_contraseña', 'OficialControlador@getRestablecerContraseña');
	Route::get('oficial/cambiar_contraseña', 'OficialControlador@getCambiarContraseña');
	Route::post('oficial/update_password', 'OficialControlador@postUpdatePassword');

//Sección rutas empleado----------------------------------------------

	Route::get('empleado', 'EmpleadoControlador@getRecibosPendientes');

	Route::get('empleado/recibos_pendientes', 'EmpleadoControlador@getRecibosPendientes');
	Route::get('empleado/ver_recibo_pendiente_firma_empleado/{id}', 'EmpleadoControlador@getVerReciboPendienteFirmaEmpleado');

	Route::post('empleado/firmar_recibo','EmpleadoControlador@postFirmarRecibo');
	Route::post('empleado/firma_recibos', 'EmpleadoControlador@postFirmaMasiva');

	Route::get('empleado/recibos_firmados', 'EmpleadoControlador@getRecibosFirmados');
	Route::get('empleado/ver_recibo_firmado_empresa_empleado/{id}', 'EmpleadoControlador@getVerReciboFirmadoEmpresaEmpleado');
	Route::get('empleado/cambiar_contraseña', 'EmpleadoControlador@getCambiarContraseña');
	Route::post('empleado/update_password', 'EmpleadoControlador@postUpdatePassword');

	Route::get('empleado/contactar_rrhh', 'EmpleadoControlador@getContactarRrhh');


});




