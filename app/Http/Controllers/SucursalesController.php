<?php namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\SucursalesFormRequest;  
use sisVentas\Sucursales;
use DB;
use Fpdf;


class SucursalesController extends Controller
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
            $sucursales=DB::table('sucursales')->where('nombre','LIKE','%'.$query.'%')
            //->where ('estado','=','Activo')
            ->orderBy('idsucursal','asc')
            ->paginate(7);
            return view('administracion.sucursales.index',["sucursales"=>$sucursales,"searchText"=>$query]);
        }
    }
    public function create()
    {
        return view("administracion.sucursales.create");
    }
    public function store (SucursalesFormRequest $request)
    {
        $sucursales = new Sucursales;
        $sucursales->nombre=$request->get('nombre');
        $sucursales->direccion=$request->get('direccion');
        $sucursales->telefono=$request->get('telefono');
        $sucursales->estado='Activo';
        $sucursales->save();
        return Redirect::to('administracion/sucursales');

    }
    public function show($id)
    {
        return view("administracion.sucursales.show",["sucursales"=>Sucursales::findOrFail($id)]);
    }
    public function edit($id)
    {
        return view("administracion.sucursales.edit",["sucursales"=>Sucursales::findOrFail($id)]);
    }
    public function update(SucursalesFormRequest $request,$id)
    {
        $sucursales=Sucursales::findOrFail($id);
        $sucursales->nombre=$request->get('nombre');
        $sucursales->direccion=$request->get('direccion');
        $sucursales->telefono=$request->get('telefono');
        $sucursales->estado=$request->get('estado');
        $sucursales->update();
        return Redirect::to('administracion/sucursales');
    }
    public function destroy($id)
    {
        $sucursales=Sucursales::findOrFail($id);
        $sucursales->estado='0';
        $sucursales->update();
        return Redirect::to('administracion/sucursales');
    }   
    public function reporte(){
         //Obtenemos los registros
         $registros=DB::table('sucursales')
            ->where ('estado','=','1')
            ->orderBy('idsucursal','asc')
            ->get();

         $pdf = new Fpdf();
         $pdf::AddPage();
         $pdf::SetTextColor(35,56,113);
         $pdf::SetFont('Arial','B',11);
         $pdf::Cell(0,10,utf8_decode("Listado Sucursales"),0,"","C");
         $pdf::Ln();
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(206, 246, 245); // establece el color del fondo de la celda 
         $pdf::SetFont('Arial','B',10); 
         //El ancho de las columnas debe de sumar promedio 190        
         $pdf::cell(20,8,utf8_decode("Idsucursal"),1,"","L",true);
         $pdf::cell(50,8,utf8_decode("Nombre"),1,"","L",true);
         $pdf::cell(80,8,utf8_decode("Direccion"),1,"","L",true);
         $pdf::cell(20,8,utf8_decode("Telefono"),1,"","L",true);
         
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(255, 255, 255); // establece el color del fondo de la celda
         $pdf::SetFont("Arial","",9);
         
         foreach ($registros as $reg)
         {
            $pdf::cell(20,6,utf8_decode($reg->idsucursal),1,"","L",true);
            $pdf::cell(50,6,utf8_decode($reg->nombre),1,"","L",true);
            $pdf::cell(80,6,utf8_decode($reg->direccion),1,"","L",true);
            $pdf::cell(20,6,utf8_decode($reg->telefono),1,"","L",true);
            
            $pdf::Ln(); 
         }

         $pdf::Output();
         exit;
    } 
    
}
