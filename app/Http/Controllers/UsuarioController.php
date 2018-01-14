<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;

use sisVentas\User;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\UsuarioFormRequest;
use DB;

class UsuarioController extends Controller
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
            $usuarios=DB::table('users')->where('name','LIKE','%'.$query.'%')
            ->orderBy('id','asc')
            ->paginate(7);
            return view('seguridad.usuario.index',["usuarios"=>$usuarios,"searchText"=>$query]);
        }
    }

    public function create()
    {
        
         $empleados=DB::table('empleados as emp')->where('estado','=','Activo')->get();
         $sucursales=DB::table('sucursales as suc')->where('estado','=','Activo')->get();
         
         $inventarios = DB::table('inventarios as inv')
                

            ->join('sucursales as suc','suc.idsucursal','=','inv.idsucursal')     

         ->select(DB::raw('CONCAT(emp.idempleado, " ",emp.nombre) as empleados'))
         ->select(DB::raw('CONCAT(suc.idsucursal, " ",suc.nombre) as sucursales'))

          ->select(DB::raw('CONCAT(inv.idarticulo, " ",inv.descripcion) as inventarios'),'inv.idarticulo','inv.cantidad',DB::raw('avg(inv.precioventa) as precio_venta'))
            
            ->where('inv.estado','=','Activo')
            ->where('inv.cantidad','>','0')
            ->groupBy('inventarios','inv.idarticulo','inv.cantidad')
            
            ->get();
        
        

        return view("seguridad.usuario.create",["sucursales"=>$sucursales,"empleados"=>$empleados]);
    }


    public function store (UsuarioFormRequest $request)
    {
        $usuario=new User;
        $usuario->name=$request->get('name');
        $usuario->email=$request->get('email');
        $usuario->password=bcrypt($request->get('password'));
        $usuario->tipousuario=$request->get('tipousuario');
        $usuario->idempleado=$request->get('idempleado');
        $usuario->estado=$request->get('estado');
        $usuario->save();
        return Redirect::to('seguridad/usuario');
    }
    public function edit($id)
    {
        return view("seguridad.usuario.edit",["usuario"=>User::findOrFail($id)]);
    }    
    public function update(UsuarioFormRequest $request,$id)
    {
        $usuario=User::findOrFail($id);
        $usuario->name=$request->get('name');
        $usuario->email=$request->get('email');
        $usuario->password=bcrypt($request->get('password'));
        $usuario->tipousuario=$request->get('tipousuario');
        $usuario->idempleado=$request->get('idempleado');
        $usuario->idsucursal=$request->get('idsucursal');
        $usuario->estado=$request->get('estado');
        $usuario->update();
        return Redirect::to('seguridad/usuario');
    }
    public function destroy($id)
    {
        $usuario = DB::table('users')->where('id', '=', $id)->delete();
        return Redirect::to('seguridad/usuario');
    }
}
