<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo_recibo extends Model
{
	 protected $table = 'grupos_recibos';
     protected $primaryKey = 'id_grupo';
     public $timestamps = false;

}
