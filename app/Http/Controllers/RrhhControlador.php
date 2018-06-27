<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periodo;

class RrhhControlador extends Controller
{
    public function getIndexRrhh()
    {
    	return view('rrhh.indexrrhh');
    }
    public function getAltaEmpleado()
    {
    	return view('rrhh.alta_empleado');
    }
    public function getBajaEmpleado()
    {
    	return view('rrhh.baja_empleado');
    }
    public function getModificacionEmpleado()
    {
    	return view('rrhh.modificacion_empleado');
    }
    public function getBusquedaEmpleado()
    {
    	return view('rrhh.busqueda_empleado');
    }
    public function getCrearNuevoPeriodo()
    {
    	return view('rrhh.crear_nuevo_periodo');
    }
    public function getCrear(Request $request)
    {
        $periodo= new Periodo();
        $periodo->estado_periodo = 0;
        $periodo->fecha = $request->año.'-'.$request->mes.'-01';
        $periodo->save();
        $estructura_carpetas_nuevos = 'C:/xampp/htdocs/sgfrs/public/recibos/nuevos/'.$request->año.'/'.$request->mes;
        $estructura_carpetas_pendientes = 'C:/xampp/htdocs/sgfrs/public/recibos/pendientes/'.$request->año.'/'.$request->mes;
        $estructura_carpetas_firmados_empresa = 'C:/xampp/htdocs/sgfrs/public/recibos/firmados_empresa/'.$request->año.'/'.$request->mes;
        $estructura_carpetas_firmados_empresa_empleados = 'C:/xampp/htdocs/sgfrs/public/recibos/firmados_empresa_empleados/'.$request->año.'/'.$request->mes;
        mkdir($estructura_carpetas_nuevos, 0777, true);
        mkdir($estructura_carpetas_pendientes, 0777, true);
        mkdir($estructura_carpetas_firmados_empresa, 0777, true);
        mkdir($estructura_carpetas_firmados_empresa_empleados, 0777, true);
        return view('rrhh.periodo_creado');
    }
    public function getValidarRecibos()
    {
    	return view('rrhh.validar_recibos');
    }
    public function getImportarRecibos()
    {
    	return view('rrhh.importar_recibos');
    }
    public function getEmpleadosSinRecibos()
    {
    	return view('rrhh.empleados_sin_recibos');
    }
    public function getCorregirRecibos()
    {
    	return view('rrhh.corregir_recibos');
    }
    public function getGruposRecibos()
    {
    	return view('rrhh.grupos_recibos');
    }
    public function getPendientesFirmaEmpresa()
    {
    	return view('rrhh.pendientes_firma_empresa');
    }
    public function getPendientesFirmaEmpleados()
    {
    	return view('rrhh.pendientes_firma_empleados');
    }
    public function getFirmadosEmpresaEmpleados()
    {
    	return view('rrhh.firmados_empresa_empleados');
    }
    public function getTodosLosRecibos()
    {
    	return view('rrhh.todos_los_recibos');
    }
    public function getInformesRrhh()
    {
    	return view('rrhh.informes_rrhh');
    }
    public function getCambiarContraseña()
    {
    	return view('rrhh.cambiar_contraseña');
    }
}
