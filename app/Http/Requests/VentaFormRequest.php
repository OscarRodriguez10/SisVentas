<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class VentaFormRequest extends Request
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
           return [
            
        ];
    }
}
