<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class ClientesFormRequest extends Request
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
