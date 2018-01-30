<?php
namespace sisVentas\Http\Controllers;
use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisVentas\Http\Requests\TipoUsuarioFormRequest;
use sisVentas\TipoUsuario;
use DB;

use Fpdf;

class TipoUsuarioController extends Controller
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
            $tipousuario=DB::table('tipo_usuario')->where('descripcion','LIKE','%'.$query.'%')
            ->where ('estado','=','Activo')
            ->orderBy('idtipo','desc')
            ->paginate(7);
            return view('seguridad.tipousuario.index',["tipousuario"=>$tipousuario,"searchText"=>$query]);
        }
    }
    public function create()
    {
        return view("seguridad.tipousuario.create");
    }
    public function store (TipoUsuarioFormRequest $request)
    {
        $tipousuario=new TipoUsuario;
        $tipousuario->descripcion=$request->get('descripcion');
        $tipousuario->estado='Activo';
        $tipousuario->save();
        return Redirect::to('seguridad/tipousuario');

    }
    public function show($id)
    {
        return view("seguridad.tipousuario.show",["tipousuario"=>TipoUsuario::findOrFail($id)]);
    }
    public function edit($id)
    {
        return view("seguridad.tipousuario.edit",["tipousuario"=>TipoUsuario::findOrFail($id)]);
    }
    public function update(TipoUsuarioFormRequest $request,$id)
    {
        $tipousuario=TipoUsuario::findOrFail($id);
        $tipousuario->descripcion=$request->get('descripcion');
        $tipousuario->update();
        return Redirect::to('seguridad/tipousuario');
    }
    public function destroy($id)
    {
        $tipousuario=TipoUsuario::findOrFail($id);
        $tipousuario->estado='Inactivo';
        $tipousuario->update();
        return Redirect::to('seguridad/tipousuario');
    }
   
}
