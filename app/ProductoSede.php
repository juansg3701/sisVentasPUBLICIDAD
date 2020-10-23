<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class ProductoSede extends Model
{
    protected $table = 'producto';
    protected $primaryKey='id_producto';
    public $timestamps =false;

    protected $fillable=[ 'plu','ean','nombre','precio','impuestos_id_impuestos','stock_minimo','categoria_id_categoria','imagen','fecha_registro','empleado_id_empleado','sede_id_sede'];
    protected $guarded=[];
}

