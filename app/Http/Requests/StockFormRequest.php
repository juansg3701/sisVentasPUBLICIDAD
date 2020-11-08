<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class StockFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'producto_id_producto'=>'required|max:45',
            'sede_id_sede'=>'required|max:45',
            'proveedor_id_proveedor'=>'required|max:45',
            'categoria_id_categoria'=>'required|max:45',
            'cantidad'=>'required|max:45',
            'producto_dados_baja'=>'|max:45', 
            'fecha_vencimiento'=>'max:45', 
            'empleado_id_empleado'=>'|max:45',
            'fecha_registro'=>'|max:45',
            'tipo_stock_id'=>'|max:45',
        ];
    }
}
