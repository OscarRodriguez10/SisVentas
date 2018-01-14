@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

		<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
			<div class="form-group">
				
				<input type="number" name="pidsucursal" id="pidsucursal" value="{{ Auth::user()->idsucursal}}" class="form-control" 
				placeholder="Idsucural.." style="visibility:hidden">
			</div>
		</div>

		<h3>Listado de traslados <a href=" " <button class="nueva-clase"> <button class="btn btn-success">Nuevo</button></a> <a href="{{url('reporteventas')}}" target="_blank"><button class="btn btn-info">Reporte</button></a></h3>
		@include('movimientos.traslados.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>NO.TRASLADOS</th>
					<th>Fecha</th>
					<th>Empleado</th>
					<th>Observacion</th>
					<th>Total</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
               @foreach ($traslados as $tras)
				<tr>
					<td>{{ $tras->idtraslado}}</td>
					<td>{{ $tras->fecha_hora}}</td>
					<td>{{ $tras->nombre}}</td>
					<td>{{ $tras->observacion}}</td>
					<td>{{ $tras->total}}</td>
					<td>{{ $tras->estado}}</td>
					<td>
						<a href="{{URL::action('TrasladosController@show',$tras->idtraslado)}}"><button class="btn btn-primary">Detalles</button></a>
						<a target="_blank" href="{{URL::action('TrasladosController@reportec',$tras->idtraslado)}}"><button class="btn btn-info">Reporte</button></a>
                         <a href="" data-target="#modal-delete-{{$tras->idtraslado}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
					</td>
				</tr>
				@include('movimientos.traslados.modal')
				@endforeach
			</table>
		</div>
		{{$traslados->render()}}
	</div>
</div>
@push ('scripts')
<script>
$('#liVentas').addClass("treeview active");
$('#liVentass').addClass("active");
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