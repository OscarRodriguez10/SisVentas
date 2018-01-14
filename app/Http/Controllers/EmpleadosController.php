<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;
use sisVentas\Empleados;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\EmpleadoFormRequest;
use DB;

use Fpdf;


class EmpleadosController extends Controller
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
            $empleados=DB::table('empleados as e')
            ->join('sucursales as s','s.idsucursal','=','e.idsucursal','')
            ->select('e.idempleado','e.nombre','e.dpi','e.direccion','e.telefono','e.puesto','s.nombre as sucursales','e.fechainicio','e.fechafinal','e.estado')
            ->where('e.nombre','LIKE','%'.$query.'%')
            ->orderBy('e.idempleado','desc')
            ->paginate(7);
            return view('administracion.empleados.index',["empleados"=>$empleados,"searchText"=>$query]);
        }
    }

    public function create()
    {
     return view("administracion.empleados.create");       
    }

    public function store(Request $request)
    {
        $empleados=new Empleados;
        $empleados->nombre=$request->get('nombre');
        $empleados->dpi=$request->get('dpi');
        $empleados->direccion=$request->get('direccion');
        $empleados->telefono=$request->get('telefono');
        $empleados->puesto=$request->get('puesto');
        $empleados->idsucursal=$request->get('idsucursal');
        $empleados->fechainicio=$request->get('fechainicio');
        $empleados->fechafinal=$request->get('fechafinal');
        $empleados->estado=$request->get('estado');
        $empleados->save();
        return Redirect::to('administracion/empleados');
    }

    public function show($id)
    {
     return view("administracion.empleados.show",["empleados"=>Empleados::findOrFail($id)]);   
    }

    public function edit($id)
    {
     return view("administracion.empleados.edit",["empleados"=>Empleados::findOrFail($id)]);
    }

    public function update(EmpleadoFormRequest $request,$id)
    {
        $empleados=Empleados::findOrFail($id);
        $empleados->nombre=$request->get('nombre');
        $empleados->dpi=$request->get('dpi');
        $empleados->direccion=$request->get('direccion');
        $empleados->telefono=$request->get('telefono');
        $empleados->puesto=$request->get('puesto');
        $empleados->idsucursal=$request->get('idsucursal');
        $empleados->fechainicio=$request->get('fechainicio');
        $empleados->fechafinal=$request->get('fechafinal');
        $empleados->estado=$request->get('estado');
        $empleados->update();
        return Redirect::to('administracion/empleados');
    }

    public function destroy($id)
    {
        $empleados=Empleados::findOrFail($id);
        $empleados->estado='0';
        $empleados->update();
        return Redirect::to('administracion/empleados');
    }
}
