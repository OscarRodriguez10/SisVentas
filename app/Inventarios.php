<?php
namespace sisVentas;
use Illuminate\Database\Eloquent\Model;

class Inventarios extends Model
{
    protected $table='inventarios';

    protected $primaryKey='idinventario';

    public $timestamps=false;


    protected $fillable =[
    	'cantidad',
    	'idarticulo',
    	'descripcion',
    	'preciocosto',
        'precioventa',
        'idsucursal',
        'estado'
        
    ];

    protected $guarded =[

    ];
}
