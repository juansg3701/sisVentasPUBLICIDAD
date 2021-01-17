<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class StockClientes extends Model
{
    protected $table = 'stock_clientes';
    protected $primaryKey='id_stock_clientes';
    public $timestamps =false;
    
    protected $fillable=['nombre','sede_id_sede_cliente','sede_id_sede','categoria_id_categoria','cantidad', 'producto_dados_baja', 'fecha_vencimiento', 'empleado_id_empleado', 'fecha_registro','empresa_id_empresa','empresa_categoria_id','plu','ean','precio','imagen','categoria_dias_especiales_id', 'descripcion'];
    protected $guarded=[];
}
