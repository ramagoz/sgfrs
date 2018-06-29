<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periodo;
use App\Persona;

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
    public function getRecibosImportados(Request $request)
    {
        $mes=$request->mes;
        $año=$request->año;
        $dir = "C:/xampp/htdocs/sgfrs/public/recibos/nuevos/".$año."/".$mes."/";
        $a=0;$b=0;$c=0;$d=0;
        foreach (scandir($dir) as $f)//esta funcion permite leer el nombre de los archivos contenidos en un directorio
        {
          if ($f !== '.' and $f !== '..')// se descarta del directorio el "." y ".."
          {
            if (strtolower(substr($f, -4))== '.pdf') //se controlar si la extension es .pdf
            {
                if (substr($f, -9, 3)== "-".$mes and substr($f, -6, 2)== substr($año,-2)) 
                //se verifica si el mes y año corresponde con el que se quiere importar
                {
                        $cedula= substr($f, 0, (strlen($f)-9));
                        $persona= Persona::find($cedula);
                        if (!empty($persona)) 
                        {
                            $recibos[$a] = $f;
                            $a++;
                        }
                        else
                        {//aqui se guardan los recibos que el numero de cedula no corresponde
                            $recibo_error_cedula[$d] =$f;
                            $d++;
                        }
                }
                else
                {//aqui se guardan los recibos que estan mal su periodo
                    $recibo_error_periodo[$b] = $f;
                    $b++;
                }
            }
            else
            {//aqui se guardan los recibos que estan mal su extension
              $recibo_error_extension[$c] = $f;
              $c++;
            }
          }
        }
        if ($a>0) 
        {
            echo "Recibo Correcto<br>";
            print_r($recibos);
            echo "<br>Cantidad de recibos correctos procesados: ".count($recibos);
            echo "<br>";
        }
        if ($b>0) 
        {
            echo "Recibo error de periodo<br>";
            print_r($recibo_error_periodo);
            echo "<br>Cantidad de recibos con error de periodo: ".count($recibo_error_periodo);
            echo "<br>";
        }
        if ($c>0) 
        {
            echo "Recibo error de extension<br>";
            print_r($recibo_error_extension);
            echo "<br>Cantidad de recibos con error de extension: ".count($recibo_error_extension);
            echo "<br>";
        }
        if ($d>0) 
        {
            echo "Recibo error de cedula<br>";
            print_r($recibo_error_cedula);
            echo "<br>Cantidad de recibos con error de cedula: ".count($recibo_error_cedula);
            echo "<br>";
        }
        //return view('rrhh.recibos_importados')->with('recibos',$recibos);;
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
