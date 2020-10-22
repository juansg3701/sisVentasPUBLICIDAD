<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class ProveedorSede extends Model
{
    protected $table = 'stock';
    protected $primaryKey='id_stock';
    public $timestamps =false;
    
    protected $fillable=['producto_id_producto','sede_id_sede','proveedor_id_proveedor','disponibilidad','cantidad', 'producto_dados_baja', 'fecha_vencimiento', 'empleado_id_empleado', 'sede_id_sede', 'fecha_registro'];
    protected $guarded=[];
}

