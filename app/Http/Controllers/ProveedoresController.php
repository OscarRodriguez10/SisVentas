<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;
use sisVentas\Proveedores;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\ProveedoresFormRequest;
use DB;

use Fpdf;

class ProveedoresController extends Controller
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
            $proveedores=DB::table('proveedores')
            ->where('nombre','LIKE','%'.$query.'%')
            ->orwhere('nombre_contacto','LIKE','%'.$query.'%')
            ->orderBy('idproveedor','asc')
            ->paginate(7);
            return view('almacen.proveedores.index',["proveedores"=>$proveedores,"searchText"=>$query]);
        }
    }
    public function create()
    {
        return view("almacen.proveedores.create");
    }
    public function store (ProveedoresFormRequest $request)
    {
        $proveedores =new Proveedores;
        $proveedores->nombre=$request->get('nombre');
        $proveedores->nombre_contacto=$request->get('nombre_contacto');
        $proveedores->direccion=$request->get('direccion');
        $proveedores->telefono=$request->get('telefono');
        $proveedores->politica=$request->get('politica');
        $proveedores->email=$request->get('email');
        $proveedores->nombre_cuenta=$request->get('nombre_cuenta');
        $proveedores->no_cuenta=$request->get('no_cuenta');
        $proveedores->opcion_compra=$request->get('opcion_compra');
        $proveedores->estado=$request->get('estado');     
        $proveedores->save();
        return Redirect::to('almacen/proveedores');

    }
    public function show($id)
    {
        return view("almacen.proveedores.show",["proveedores"=>Proveedores::findOrFail($id)]);
    }
    public function edit($id)
    {
        return view("almacen.proveedores.edit",["proveedores"=>Proveedores::findOrFail($id)]);
    }
    public function update(ProveedoresFormRequest $request,$id)
    {
        
        $proveedores=Proveedores::findOrFail($id);
        $proveedores->nombre=$request->get('nombre');
        $proveedores->nombre_contacto=$request->get('nombre_contacto');
        $proveedores->direccion=$request->get('direccion');
        $proveedores->telefono=$request->get('telefono');
        $proveedores->politica=$request->get('politica');
        $proveedores->email=$request->get('email');
        $proveedores->nombre_cuenta=$request->get('nombre_cuenta');
        $proveedores->no_cuenta=$request->get('no_cuenta');
        $proveedores->opcion_compra=$request->get('opcion_compra');
        $proveedores->estado=$request->get('estado');     
        $proveedores->update();
        return Redirect::to('almacen/proveedores');
    }
    
    public function destroy($id)
    {
        $proveedores=Proveedores::findOrFail($id);
        $proveedores->estado='0';
        $proveedores->update();
        return Redirect::to('almacen/proveedores');
    }

    public function reporte(){
         //Obtenemos los registros
         $registros=DB::table('proveedores')
            ->orderBy('idproveedor','asc')
            ->get();

         $pdf = new Fpdf();
         $pdf::AddPage();
         $pdf::SetTextColor(35,56,113);
         $pdf::SetFont('Arial','B',11);
         $pdf::Cell(0,10,utf8_decode("Listado Proveedores"),0,"","C");
         $pdf::Ln();
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(206, 246, 245); // establece el color del fondo de la celda 
         $pdf::SetFont('Arial','B',10); 
         //El ancho de las columnas debe de sumar promedio 190        
         $pdf::cell(10,8,utf8_decode("Id"),1,"","L",true);
         $pdf::cell(40,8,utf8_decode("Nombre"),1,"","L",true);
         $pdf::cell(75,8,utf8_decode("Direccion"),1,"","L",true);
         $pdf::cell(20,8,utf8_decode("Telefono"),1,"","L",true);
         $pdf::cell(30,8,utf8_decode("OpcionCompra"),1,"","L",true);
         $pdf::cell(15,8,utf8_decode("Estado"),1,"","L",true);

         
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(255, 255, 255); // establece el color del fondo de la celda
         $pdf::SetFont("Arial","",9);
         
         foreach ($registros as $prove)
         {
            $pdf::cell(10,8,utf8_decode($prove->idproveedor),1,"","L",true);
            $pdf::cell(40,8,utf8_decode($prove->nombre),1,"","L",true);
            $pdf::cell(75,8,utf8_decode($prove->direccion),1,"","L",true);
            $pdf::cell(20,8,utf8_decode($prove->telefono),1,"","L",true);
            $pdf::cell(30,8,utf8_decode($prove->opcion_compra),1,"","L",true);
            $pdf::cell(15,8,utf8_decode($prove->estado),1,"","L",true);
            $pdf::Ln(); 
         }

         $pdf::Output();
         exit;
    }
}
