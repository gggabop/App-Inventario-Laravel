<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
     protected $table = 'productos';

     /*=============================================
     INNER JOIN DESDE EL MODELO
     =============================================*/
     public function distribuidores(){

     	return $this->belongsTo('App\Distribuidores', 'id_fk_distribuidor', 'id_distribuidor');

     }
     
}
