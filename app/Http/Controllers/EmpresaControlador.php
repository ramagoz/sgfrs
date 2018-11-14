<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recibo;
use App\Grupo_recibo;
use App\Periodo;
use App\Persona;
use DB;


class EmpresaControlador extends Controller
{
    public function getIndexEmpresa()
    {
    	return view('empresa.indexempresa');
    }
    public function getAltaOficial()
    {
    	return view('empresa.alta_oficial');
    }
     public function getBajaOficial()
    {
    	return view('empresa.baja_oficial');
    }
     public function getModificacionOficial()
    {
    	return view('empresa.modificacion_oficial');
    }
     public function getBusquedaOficial()
    {
    	return view('empresa.busqueda_oficial');
    }
     public function getRecibosPendientesEmpresa()
    {
        $recibos = DB::table('recibos')
        ->join('personas', 'recibos.cedula','=','personas.cedula')
        ->where('recibos.id_estado_recibo', '1')
        ->get();

    	return view('empresa.recibos_pendientes_empresa')->with('recibos',$recibos);
    }
    public function getVerRecibo($id)
    {
        $id="/recibos/pendientes/"."20".substr($id, -2, 2)."/".substr($id, -4, 2)."/".$id.".pdf";
        return view('empresa.ver_recibo_pendiente_firma_empresa')->with('id',$id);
    }
     public function getRecibosPendientesEmpleados()
    {
        $recibos = DB::table('recibos')
        ->join('personas', 'recibos.cedula','=','personas.cedula')
        ->where('recibos.id_estado_recibo', '2')
        ->get();

    	return view('empresa.recibos_pendientes_empleados')->with('recibos',$recibos);
    }
    public function getVerReciboPendienteFirmaEmpleado($id)
    {
        $id="/recibos/firmados_empresa/"."20".substr($id, -2, 2)."/".substr($id, -4, 2)."/".$id.".pdf";
        return view('empresa.ver_recibo_pendiente_firma_empleado')->with('id',$id);
    }

     public function getRecibosFirmadosEmpresa()
    {
    	return view('empresa.recibos_firmados_empresa');
    }
     public function getInformesEmpresa()
    {
    	return view('empresa.informes_empresa');
    }
     public function getCambiarContraseña()
    {
    	return view('empresa.cambiar_contraseña');
    }

}
