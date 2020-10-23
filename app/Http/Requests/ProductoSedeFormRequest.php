<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class ProductoSedeFormRequest extends Request
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
            'plu'=>'required|max:45',
            'ean'=>'max:45',
            'nombre'=>'required|max:45',
            'precio'=>'required|max:45',
            'stock_minimo'=>'required|max:45',
            'categoria_id_categoria'=>'required|max:45',
            'imagen'=>'|max:2000',
            'fecha_registro'=>'required|max:45',
            'empleado_id_empleado'=>'required|max:45',
            'sede_id_sede'=>'required|max:45',
        ];
    }
}
