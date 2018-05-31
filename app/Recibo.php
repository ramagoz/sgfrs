<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
	 protected $table = 'recibos';
     protected $primaryKey = 'id_recibo';
     public $timestamps = false;

}
