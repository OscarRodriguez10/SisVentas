@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de productos</h3>
		@include('consulta.sucursales.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Idarticulo</th>
					<th>Cantidad</th>
					<th>Descripcion</th>
					<th>Sucursales</th>
					
					<th></th>
				</thead>
               @foreach ($consultas as $con)
				<tr>
					<td>{{ $con->idarticulo}}</td>
					<td>{{ $con->cantidad}}</td>
					<td>{{ $con->descripcion}}</td>
					<td>{{ $con->sucursales}}</td>
				</tr>
				@include('consulta.sucursales.modal')
				@endforeach
			</table>
		</div>
		{{$consultas->render()}}
	</div>
</div>
@push ('scripts')
<script>
$('#liConsulta').addClass("treeview active");
$('#liSucursales').addClass("active");
</script>
@endpush
@endsection