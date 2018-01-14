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


class InventariosController extends Controller
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
            $inventarios=DB::table('inventarios as i')
            ->join('articulo as a','i.idarticulo','=','a.idarticulo','')
            ->join('sucursales as s','i.idsucursal','=','s.idsucursal','')
            
            ->select('i.idinventario','i.cantidad','i.idarticulo','i.descripcion','i.preciocosto','i.precioventa','i.subcosto','i.subventa','i.estado','s.nombre as sucursales')
            ->where('i.descripcion','LIKE','%'.$query.'%')
            ->orderBy('i.idinventario','desc')
            ->paginate(7);
    return view('almacen.inventarios.index',['inventarios'=>$inventarios,"searchText"=>$query]);
        }
    }
    public function create()
    {
        
        $sucursales=DB::table('sucursales as suc')->where('estado','=','Activo')->get();
        
        $articulos = DB::table('articulo as art')
                

            
            ->select(DB::raw('CONCAT(suc.idsucursal, " ",suc.nombre) as sucursales'))

            ->select(DB::raw('CONCAT(art.idarticulo, " ",art.nombre) as articulos'),'art.idarticulo','art.preciocosto','art.nombre',DB::raw('avg(art.precioventa) as precio_venta'))
            
            
            ->where('art.estado','=','Activo')
            ->groupBy('articulos','art.idarticulo')
            ->get();
        return view("almacen.inventarios.create",["articulos"=>$articulos,"sucursales"=>$sucursales]);
    
    }

    public function show($id)
    {
        return view("almacen.inventarios.show",["inventarios"=>Inventarios::findOrFail($id)]);
    }
    
    
    public function store (InventariosFormRequest $request)
    {
        
        $inventario=new Inventarios;
        $inventario->idarticulo=$request->get('pidarticulo');
        $inventario->idsucursal=$request->get('pidsucursal');
        $inventario->cantidad=$request->get('pcantidad');
        $inventario->descripcion=$request->get('pdescripcion');
        $inventario->preciocosto=$request->get('pprecio_costo');
        $inventario->precioventa=$request->get('pprecio_venta');
        $inventario->estado=$request->get('estado');
      
        $inventario->save();
        dd($request->all());
         
        return Redirect::to('almacen/inventarios');

    }
    /*
    public function edit($id)
    {
    $articulo=Articulo::findOrFail($id);
    $categorias=DB::table('categoria')->where('condicion','=','1')->get();
    $proveedores=DB::table('proveedores')->where('estado','=','Activo')->get();
    return view("almacen.articulo.edit",["articulo"=>$articulo,"categorias"=>$categorias],
    ["articulo"=>$articulo,"proveedores"=>$proveedores]);

   // $articulo=Articulo::findOrFail($id);
    //$proveedores=DB::table('proveedores')->where('estado','=','Activo')->get();
   // ((return view("almacen.articulo.edit",["articulo"=>$articulo,"proveedores"=>$proveedores]);
    }
    
    
    public function update(ArticuloFormRequest $request,$id)
    {
        $articulo=Articulo::findOrFail($id);
        $articulo->idcategoria=$request->get('idcategoria');
        $articulo->idproveedor=$request->get('idproveedor');
        $articulo->codigo=$request->get('codigo');
        $articulo->nombre=$request->get('nombre');
        $articulo->preciocosto=$request->get('preciocosto');
        $articulo->precioventa=$request->get('precioventa');
        $articulo->precioventa2=$request->get('precioventa2');
        $articulo->formula=$request->get('formula');
        $articulo->bono=$request->get('bono');
        $articulo->estado=$request->get('estado');
        $articulo->update();
        return Redirect::to('almacen/articulo');
    }
    public function destroy($id)
    {
        $articulo=Articulo::findOrFail($id);
        $articulo->Estado='Inactivo';
        $articulo->update();
        return Redirect::to('almacen/articulo');
    }
    */
    }

 