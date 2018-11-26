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
        if ($recibos=='[]')
        {
            return view('empresa.recibos_pendientes_empresa')->with('recibos',$recibos)->with('msj','No existen recibos pendientes de firma por el empleado!');
        }else
        {
            return view('empresa.recibos_pendientes_empresa')->with('recibos',$recibos)->with('boton','boton');
        }

    	return view('empresa.recibos_pendientes_empresa')->with('recibos',$recibos);
    }
    public function getVerRecibo($id)
    {
        $id_recibo=$id;
        $id="/recibos/pendientes/"."20".substr($id, -2, 2)."/".substr($id, -4, 2)."/".$id.".pdf";
        return view('empresa.ver_recibo_pendiente_firma_empresa')->with('id',$id)->with('id_recibo',$id_recibo);
    }
    public function getFirmarReciboPendienteEmpresa($id)
    {
        $recibo =Recibo::find($id);
        $recibo->id_estado_recibo =2;
        $recibo->save();
        $mes=substr($id, -4,2);
        $año=substr($id, -2,2);
        $dir_origen= "C:/xampp/htdocs/sgfrs/public/recibos/pendientes/20" . $año . "/" . $mes . "/";
        $dir_destino= "C:/xampp/htdocs/sgfrs/public/recibos/firmados_empresa/20" . $año . "/" . $mes . "/";
        rename($dir_origen.$id.'.pdf' , $dir_destino.$id.'.pdf');
        $id="/recibos/firmados_empresa/20". $año . "/" . $mes."/".$id.".pdf";
        return view('empresa.ver_recibo_firmado_empresa')->with('id',$id)->with('msj','Recibo firmado correctamente!');
    }
     public function postFirmaMasivaRecibosPendientesEmpleados(Request $request)
    {
        //aqui se recuperan los identificadores de recibos que fueron selecionados para ser firmados
        foreach ($request->recibos_a_firmar as $key => $value) 
        {
            $recibo =Recibo::find($value);
            $recibo->id_estado_recibo =2;
            $recibo->save();
            $mes=substr($value, -4,2);
            $año=substr($value, -2,2);
            $dir_origen= "C:/xampp/htdocs/sgfrs/public/recibos/pendientes/20" . $año . "/" . $mes . "/";
            $dir_destino= "C:/xampp/htdocs/sgfrs/public/recibos/firmados_empresa/20" . $año . "/" . $mes . "/";
            rename($dir_origen.$value.'.pdf' , $dir_destino.$value.'.pdf');
        }
        $recibos = DB::table('recibos')
        ->join('personas', 'recibos.cedula','=','personas.cedula')
        ->where('recibos.id_estado_recibo', '2')
        ->get();

        return view('empresa.recibos_pendientes_empleados')->with('recibos',$recibos)->with('msj','Recibos firmados correctamente!');
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

     public function getRecibosFirmadosEmpresaEmpleados()
    {
    	return view('empresa.recibos_firmados_empresa_empleados');
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
