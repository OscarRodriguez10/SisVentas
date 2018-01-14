@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
    	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    		<div class="form-group">
            	<label for="cliente">Cliente</label>
            	<p>{{$venta->nombre}}</p>
            </div>
    	</div>
    	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
            <div class="form-group">
                <label for="idventa">No.Factura</label>
                <p>{{$venta->idventa}}</p>
            </div>
        </div>
        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
            <div class="form-group">
                <label for="nit">Nit</label>
                <p>{{$venta->nit}}</p>
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-body">            

                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color:#A9D0F5">
                            
                            <th>Artículo</th>
                            <th>Cantidad</th>
                            <th>Precio Venta</th>
                           
                            <th>Subtotal</th>
                        </thead>
                        <tfoot>
                            <tr>
                                <th  colspan="4"><p align="right">TOTAL:</p></th>
                                <th><p align="right">Q/. {{$venta->total_venta}}</p></th>
                            </tr>
                            <tr>
                                <th  colspan="4"><p align="right">TOTAL PAGAR:</p></th>
                                <th><p align="right">Q/. {{$venta->total_venta}}</p></th>
                            </tr>  
                        </tfoot>
                        <tbody>
                            @foreach($detalles as $det)
                            <tr>
                                <td>{{$det->articulo}}</td>
                                <td>{{$det->cantidad}}</td>
                                <td>Q/. {{$det->precio_venta}}</td>
                                <td align="right">Q/. {{$det->cantidad*$det->precio_venta}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                 </div>
            </div>
        </div>
    	
    </div>   
@push ('scripts')
<script>
$('#liVentas').addClass("treeview active");
$('#liVentass').addClass("active");
</script>
@endpush
@endsection