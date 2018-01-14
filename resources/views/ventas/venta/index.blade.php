@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
	<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
			<div class="form-group">
				<label for="pidsucursal">Sucursal </label>
				<input type="number" name="pidsucursal" id="pidsucursal" value="{{ Auth::user()->idsucursal}}" class="form-control" 
				placeholder="Idsucural..">
			</div>
		</div>
		<h3>Listado de Ingresos <a href="" <button class="nueva-clase"> <button class="btn btn-success">Nuevo</button></a> <a href="{{url('reporteventas')}}" target="_blank"><button class="btn btn-info">Reporte</button></a></h3>
		@include('ventas.venta.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>NO.FACTURA</th>
					<th>Fecha</th>
					<th>Cliente</th>
					<th>Nit</th>
					<th>Direccion</th>
					<th>Total</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
               @foreach ($ventas as $ven)
				<tr>
					<td>{{ $ven->idventa}}</td>
					<td>{{ $ven->fecha_hora}}</td>
					<td>{{ $ven->nombre}}</td>
					<td>{{ $ven->nit}}</td>
					<td>{{ $ven->direccion}}</td>
					<td>{{ $ven->total_venta}}</td>
					<td>{{ $ven->estado}}</td>
					<td>



						<a href="{{URL::action('VentaController@show',$ven->idventa)}}"><button class="btn btn-primary">Detalles</button></a>
						<a target="_blank" href="{{URL::action('VentaController@reportec',$ven->idventa)}}"><button class="btn btn-info">Reporte</button></a>
                         <a href="" data-target="#modal-delete-{{$ven->idventa}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
					</td>
				</tr>
				@include('ventas.venta.modal')
				@endforeach
			</table>
		</div>
		{{$ventas->render()}}
	</div>
</div>
@push ('scripts')
<script>
$('#liCompras').addClass("treeview active");
$('#liIngresos').addClass("active");
</script>
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript">
	jQuery( document ).ready( function( $ )
	{ 
		$('.nueva-clase').on('click', function(e){
			e.preventDefault();
			console.log("create/"+$("#pidsucursal").val());
			window.location = "create/"+$("#pidsucursal").val();
		});
	});
</script>
@endpush
@endsection