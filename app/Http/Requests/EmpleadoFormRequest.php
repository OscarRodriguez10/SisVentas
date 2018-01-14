<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class EmpleadoFormRequest extends Request
{
    
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return [
        'nombre'=>'required|max:200',
        'dpi'=>'max:30',
        'direccion'=>'max:250',
        'puesto'=>'max:250',
        'fechainicio'=>'requiered|max:20',
        ];
    }
}
