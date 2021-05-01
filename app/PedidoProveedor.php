<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class PedidoProveedor extends Model
{
    protected $table = 't_p_proveedor';
    protected $primaryKey='id_remision';
    public $timestamps =false;
    
    protected $fillable=['noproductos', 'fecha_solicitud', 'fecha_entrega', 'pago_inicial', 'porcentaje_venta', 'pago_total', 'empleado_id_empleado', 'tipo_pago_id_tpago', 'finalizar'];
    protected $guarded=[];
}
