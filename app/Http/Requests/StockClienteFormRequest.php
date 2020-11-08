<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class StockClienteFormRequest extends Request
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
            'nombre'=>'required|max:45',
            'sede_id_sede'=>'required|max:45',
            'sede_id_sede_cliente'=>'required|max:45',
            'empresa_categoria_id'=>'required|max:45',
            'categoria_id_categoria'=>'required|max:45',
            'cantidad'=>'required|max:45',
            'producto_dados_baja'=>'|max:45', 
            'fecha_vencimiento'=>'max:45', 
            'empleado_id_empleado'=>'|max:45',
            'fecha_registro'=>'|max:45',
            'empresa_id_empresa'=>'|max:45',
            'plu'=>'|max:45',
            'ean'=>'|max:45',
            'precio'=>'|max:45',
            'imagen'=>'|max:45',
            'categoria_dias_especiales_id'=>'required|max:45',
        ];
    }
}
