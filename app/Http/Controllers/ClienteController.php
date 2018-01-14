<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;
use sisVentas\Clientes;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\ClientesFormRequest;
use DB;

use Fpdf;

class ClienteController extends Controller
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
            $clientes=DB::table('clientes')
            
            ->where('nombre','LIKE','%'.$query.'%')
            ->where('nit','LIKE','%'.$query.'%')
            ->orderBy('idcliente','asc')
            ->paginate(7);
            return view('ventas.cliente.index',["clientes"=>$clientes,"searchText"=>$query]);
        }
    }
    public function create()
    {
        return view("ventas.cliente.create");
    }
    public function store (ClientesFormRequest $request)
    {
        $clientes=new Clientes;
        $clientes->nombre=$request->get('nombre');
        $clientes->direccion=$request->get('direccion');
        $clientes->telefono=$request->get('telefono');
        $clientes->nit=$request->get('nit');
        $clientes->email=$request->get('email');
        $clientes->estado=$request->get('estado');
        $clientes->save();
        return Redirect::to('ventas/cliente');
    }
    public function show($id)
    {
        return view("ventas.cliente.show",["clientes"=>Clientes::findOrFail($id)]);
    }
    public function edit($id)
    {
        return view("ventas.cliente.edit",["clientes"=>Clientes::findOrFail($id)]);
    }
    
    public function update(ClientesFormRequest $request,$id)
    {
        $clientes=Clientes::findOrFail($id);

        $clientes->nombre=$request->get('nombre');
        $clientes->direccion=$request->get('direccion');
        $clientes->telefono=$request->get('telefono');
        $clientes->nit=$request->get('nit');
        $clientes->email=$request->get('email');
        $clientes->estado=$request->get('estado');
        
        $clientes->update();
        return Redirect::to('ventas/cliente');
    }
    public function destroy($id)
    {
        $clientes=Clientes::findOrFail($id);
        $clientes->estado='0';
        $clientes->update();
        return Redirect::to('ventas/cliente');
    }
    public function reporte(){
         //Obtenemos los registros
         $registros=DB::table('clientes')
            
            ->orderBy('idcliente','asc')
            ->get();

         $pdf = new Fpdf();
         $pdf::AddPage();
         $pdf::SetTextColor(35,56,113);
         $pdf::SetFont('Arial','B',11);
         $pdf::Cell(0,10,utf8_decode("Listado Clientes"),0,"","C");
         $pdf::Ln();
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(206, 246, 245); // establece el color del fondo de la celda 
         $pdf::SetFont('Arial','B',10); 
         //El ancho de las columnas debe de sumar promedio 190        
         $pdf::cell(70,8,utf8_decode("Nombre"),1,"","L",true);
         $pdf::cell(40,8,utf8_decode("Direccion"),1,"","L",true);
         $pdf::cell(20,8,utf8_decode("Telefono"),1,"","L",true);
         $pdf::cell(15,8,utf8_decode("Nit"),1,"","L",true);
         $pdf::cell(50,8,utf8_decode("Email"),1,"","L",true);
         $pdf::cell(15,8,utf8_decode("Estado"),1,"","L",true);
         
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(255, 255, 255); // establece el color del fondo de la celda
         $pdf::SetFont("Arial","",9);
         
         foreach ($registros as $cli)
         {
            $pdf::cell(70,8,utf8_decode($cli->nombre),1,"","L",true);
            $pdf::cell(40,8,utf8_decode($cli->direccion),1,"","L",true);
            $pdf::cell(20,8,utf8_decode($cli->telefono),1,"","L",true);
            $pdf::cell(15,8,utf8_decode($cli->nit),1,"","L",true);
            $pdf::cell(50,8,utf8_decode($cli->email),1,"","L",true);
            $pdf::cell(15,8,utf8_decode($cli->estado),1,"","L",true);
            $pdf::Ln(); 
         }

         $pdf::Output();
         exit;
    }
}
