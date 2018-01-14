<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class SucursalesFormRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
             'nombre'=>'required|max:100',
             'direccion'=>'max:256',
             'telefono'=>'max:20',
             ];
    }
}
