<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado_recibo extends Model
{
	 protected $table = 'estado_recibos';
     protected $primaryKey = 'id_estado_recibo';
     public $timestamps = false;
}
