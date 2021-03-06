<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class FacturaCobrarDetalleFormRequest extends Request
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
            'fecha'=>'required|max:45',
            'valor_abono'=>'required|max:45', 
            'valor_total'=>'required|max:45', 
            'valor_restante'=>'required|max:45', 
            'empleado_id_empleado'=>'required|max:45', 
            'tipo_pago'=>'required|max:45',
            'id_cartera'=>'required|max:45', 
        ];
    }
}
