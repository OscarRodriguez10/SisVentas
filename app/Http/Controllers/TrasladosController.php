<?php
namespace sisVentas\Http\Controllers;
use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisVentas\Http\Requests\TrasladosFormRequest;
use sisVentas\Traslados;
use sisVentas\DetalleTraslados;
use DB;
use Fpdf;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class TrasladosController extends Controller
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
        $traslados=DB::table('traslados as t')
        ->join('empleados as e','t.idempleado','=','e.idempleado')
        ->join('detalle_traslados as dt','t.idtraslado','=','dt.idtraslado')
        ->select('t.idtraslado','t.fecha_hora','e.nombre','t.observacion','t.total','t.estado')

            
        ->where('t.idtraslado','LIKE','%'.$query.'%')
        ->orderBy('t.idtraslado','desc')
        ->groupBy('t.idtraslado','t.fecha_hora','e.nombre','t.observacion','t.total','t.estado')
        ->paginate(7);
         return view('movimientos.traslados.index',["traslados"=>$traslados,"searchText"=>$query]);
    
        }
    }
    public function create($id_sucursal)
    {

    	$empleados=DB::table('empleados')->where('estado','=','Activo')->get();
        $sucursales=DB::table('sucursales')->where('estado','=','Activo')->get();
        //$empleados=DB::table('empleados')->where('estado','=','Activo')->get();
        
        $inventarios = DB::table('inventarios as inv')
                

            ->join('sucursales as suc','suc.idsucursal','=','inv.idsucursal')
            //->join('users as user','inv.idsucursal','=','user.idsucursal')
            ->join('articulo as art','art.idarticulo','=','inv.idarticulo')
            
            ->select(DB::raw('CONCAT(sucursales.idsucursal, " ",sucursales.nombre) as sucursales'))
          
             // ->select(DB::raw('CONCAT(clientes.idcliente, " ",cliente.nombre) as clientes'),'clientes.direccion',DB::raw('avg(clientes.nit) as nit'))           

            ->select(DB::raw('CONCAT(inv.idarticulo, " ",inv.descripcion) as inventarios'),'inv.idarticulo','inv.cantidad',DB::raw('avg(inv.precioventa) as precio_venta'))
            
            ->where('inv.idsucursal','=',$id_sucursal)
            ->where('inv.estado','=','Activo')
            ->where('inv.cantidad','>','0')
            ->groupBy('inventarios','inv.idarticulo','inv.cantidad')
            
            ->get();
        return view("movimientos.traslados.create",["empleados"=>$empleados,"inventarios"=>$inventarios,"sucursales"=>$sucursales]);
    }

     
    public function store (TrasladosFormRequest $request)
    {
           try{
        	DB::beginTransaction();
            
        	$traslado = new Traslados;
	        $traslado->idempleado=$request->get('pidempleado');
	        $traslado->observacion=$request->get('pobservacion');
	        $traslado->total=$request->get('total_venta');
            $mytime = Carbon::now('America/Guatemala');
	        $traslado->fecha_hora=$mytime->toDateTimeString();
            //$venta->fecha_hora="2017-12-26 00:00:00";
	       
	        $traslado->estado='N';
	        $traslado->save();
            
	        $idarticulo = $request->get('idarticulo');
	        $suc_origen = $request->get('psuc_origen');
            $suc_destino = $request->get('psuc_destino');
            $cantidad = $request->get('cantidad');
	        $precio_venta = $request->get('precio_venta');
            $subtotal = $request->get('subtotal');
             
	        $cont = 0;
	        //$idarticulo = explode('_',$idarticulo);
            //$cantidad = explode('_',$cantidad);
            //$precio_venta = explode('_',$precio_venta);
           
            while($cont < count($idarticulo))
            {
	            $detalle = new DetalleTraslados();
                $detalle->idtraslado= $traslado->idtraslado; 
	            $detalle->idarticulo= $idarticulo[$cont];
	            $detalle->cantidad= $cantidad[$cont];
	            $detalle->precio_venta= $precio_venta[$cont];
                $detalle->subtotal= $cantidad[$cont] * $precio_venta[$cont];
                $detalle->suc_origen= $suc_origen[$cont];
                $detalle->suc_destino= $suc_destino[$cont];
                $detalle->save();
                $cont=$cont+1;            
	        }

        	DB::commit();
            dd($request->all());

             
             
        }catch(\Exception $e)
        {
          	DB::rollback();
        }

        return Redirect::to('movimientos/traslados');
    }
    
    public function show($id)
    {
    	$venta=DB::table('venta as v')
            ->join('clientes as c','v.idcliente','=','c.idcliente')
            ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
             ->select('v.idventa','v.fecha_hora','c.nombre','v.nit','v.direccion','v.estado','v.total_venta')

            ->where('v.idventa','=',$id)
            ->first();

        $detalles=DB::table('detalle_venta as d')
             ->join('articulo as a','d.idarticulo','=','a.idarticulo')
             ->select('a.nombre as articulo','d.cantidad','d.precio_venta')
             ->where('d.idventa','=',$id)
             ->get();
        return view("ventas.venta.show",["venta"=>$venta,"detalles"=>$detalles]);
    }
    
    public function destroy($id)
    {
    	$traslado  = Traslados::findOrFail($id);
        $traslado->Estado='A';
        $traslado->update();
        return Redirect::to('movimientos/traslados');
    }
    /*
    public function reportec($id){
         //Obtengo los datos
        
        $venta=DB::table('venta as v')
            ->join('persona as p','v.idcliente','=','p.idpersona')
            ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
            ->select('v.idventa','v.fecha_hora','p.nombre','p.direccion','p.num_documento','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta')
            ->where('v.idventa','=',$id)
            ->first();

        $detalles=DB::table('detalle_venta as d')
             ->join('articulo as a','d.idarticulo','=','a.idarticulo')
             ->select('a.nombre as articulo','d.cantidad','d.descuento','d.precio_venta')
             ->where('d.idventa','=',$id)
             ->get();


        $pdf = new Fpdf();
        $pdf::AddPage();
        $pdf::SetFont('Arial','B',14);
        //Inicio con el reporte
        $pdf::SetXY(170,20);
        $pdf::Cell(0,0,utf8_decode($venta->tipo_comprobante));

        $pdf::SetFont('Arial','B',14);
        //Inicio con el reporte
        $pdf::SetXY(170,40);
        $pdf::Cell(0,0,utf8_decode($venta->serie_comprobante."-".$venta->num_comprobante));

        $pdf::SetFont('Arial','B',10);
        $pdf::SetXY(35,60);
        $pdf::Cell(0,0,utf8_decode($venta->nombre));
        $pdf::SetXY(35,69);
        $pdf::Cell(0,0,utf8_decode($venta->direccion));
        //***Parte de la derecha
        $pdf::SetXY(180,60);
        $pdf::Cell(0,0,utf8_decode($venta->num_documento));
        $pdf::SetXY(180,69);
        $pdf::Cell(0,0,substr($venta->fecha_hora,0,10));
        $total=0;

        //Mostramos los detalles
        $y=89;
        foreach($detalles as $det){
            $pdf::SetXY(20,$y);
            $pdf::MultiCell(10,0,$det->cantidad);

            $pdf::SetXY(32,$y);
            $pdf::MultiCell(120,0,utf8_decode($det->articulo));

            $pdf::SetXY(162,$y);
            $pdf::MultiCell(25,0,$det->precio_venta-$det->descuento);

            $pdf::SetXY(187,$y);
            $pdf::MultiCell(25,0,sprintf("%0.2F",(($det->precio_venta-$det->descuento)*$det->cantidad)));

            $total=$total+($det->precio_venta*$det->cantidad);
            $y=$y+7;
        }

        $pdf::SetXY(187,153);
        $pdf::MultiCell(20,0,"S/. ".sprintf("%0.2F", $venta->total_venta-($venta->total_venta*$venta->impuesto/($venta->impuesto+100))));
        $pdf::SetXY(187,160);
        $pdf::MultiCell(20,0,"S/. ".sprintf("%0.2F", ($venta->total_venta*$venta->impuesto/($venta->impuesto+100))));
        $pdf::SetXY(187,167);
        $pdf::MultiCell(20,0,"S/. ".sprintf("%0.2F", $venta->total_venta));

        $pdf::Output();
        exit;
    }*/
    public function reporte(){
         //Obtenemos los registros
         $registros=DB::table('venta as v')
            ->join('persona as p','v.idcliente','=','p.idpersona')
            ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
            ->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta')
            ->orderBy('v.idventa','desc')
            ->groupBy('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado')
            ->get();

         //Ponemos la hoja Horizontal (L)
         $pdf = new Fpdf('L','mm','A4');
         $pdf::AddPage();
         $pdf::SetTextColor(35,56,113);
         $pdf::SetFont('Arial','B',11);
         $pdf::Cell(0,10,utf8_decode("Listado Ventas"),0,"","C");
         $pdf::Ln();
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(206, 246, 245); // establece el color del fondo de la celda 
         $pdf::SetFont('Arial','B',10); 
         //El ancho de las columnas debe de sumar promedio 190        
         $pdf::cell(35,8,utf8_decode("Fecha"),1,"","L",true);
         $pdf::cell(80,8,utf8_decode("Cliente"),1,"","L",true);
         $pdf::cell(45,8,utf8_decode("Comprobante"),1,"","L",true);
         $pdf::cell(10,8,utf8_decode("Imp"),1,"","C",true);
         $pdf::cell(25,8,utf8_decode("Total"),1,"","R",true);
         
         $pdf::Ln();
         $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
         $pdf::SetFillColor(255, 255, 255); // establece el color del fondo de la celda
         $pdf::SetFont("Arial","",9);
         
         foreach ($registros as $reg)
         {
            $pdf::cell(35,8,utf8_decode($reg->fecha_hora),1,"","L",true);
            $pdf::cell(80,8,utf8_decode($reg->nombre),1,"","L",true);
            $pdf::cell(45,8,utf8_decode($reg->tipo_comprobante.': '.$reg->serie_comprobante.'-'.$reg->num_comprobante),1,"","L",true);
            $pdf::cell(10,8,utf8_decode($reg->impuesto),1,"","C",true);
            $pdf::cell(25,8,utf8_decode($reg->total_venta),1,"","R",true);
            $pdf::Ln(); 
         }

         $pdf::Output();
         exit;
    }
}
