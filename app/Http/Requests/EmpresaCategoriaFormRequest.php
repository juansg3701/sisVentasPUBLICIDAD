<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class EmpresaCategoriaFormRequest extends Request
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
            'descripcion'=>'max:45',
            'empresa_id_empresa'=>'required|max:45',
            'fecha_registro'=>'required|max:45',
            'empleado_id_empleado'=>'required|max:45',
            'sede_id_sede'=>'required|max:45',
        ];
    }
}
