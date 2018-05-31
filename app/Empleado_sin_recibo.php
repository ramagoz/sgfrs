<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado_sin_recibo extends Model
{
	 protected $table = 'empleados_sin_recibos';
     protected $primaryKey = 'id_emp_sin_rec';
     public $timestamps = false;
}
