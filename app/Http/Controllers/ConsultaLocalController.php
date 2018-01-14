<?php
namespace sisVentas\Http\Controllers;
use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisVentas\Http\Requests\InventariosFormRequest;
use sisVentas\Inventarios;
use DB;
use Fpdf;

class ConsultaLocalController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $consultas=DB::table('inventarios as i')
            ->join('articulo as a','i.idarticulo','=','a.idarticulo','')
            ->join('sucursales as s','i.idsucursal','=','s.idsucursal','')
            
            ->select('i.cantidad','i.idarticulo','i.descripcion','i.precioventa','s.nombre as sucursales','i.idinventario')
            ->where('i.idsucursal','=','3')
            ->where('i.descripcion','LIKE','%'.$query.'%')
            ->orderBy('i.idinventario','desc')
            ->paginate(7);
    return view('consulta.local.index',['consultas'=>$consultas,"searchText"=>$query]);
        }
    }
}
