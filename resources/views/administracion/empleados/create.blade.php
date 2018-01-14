<?php
use sisVentas\Sucursales;
$sucursales = Sucursales::lists("nombre","idsucursal");
$sucursales[0] = "seleccione...";
?>

@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Empleado</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
 
			{!!Form::open(array('url'=>'administracion/empleados','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label for="nombre" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}">

                                @if ($errors->has('nombre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('dpi') ? ' has-error' : '' }}">
                            <label for="dpi" class="col-md-4 control-label">Dpi</label>

                            <div class="col-md-6">
                            <input id="dpi" type="text" class="form-control" name="dpi" value="{{ old('dpi') }}">

                            @if ($errors->has('dpi'))
                            <span class="help-block">
                            <strong>{{ $errors->first('dpi') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
                            <label for="direccion" class="col-md-4 control-label">Direccion</label>

                            <div class="col-md-6">
                                <input id="direccion" type="text" class="form-control" name="direccion" value="{{ old('direccion') }}">

                                @if ($errors->has('direccion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('direccion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                            <label for="telefono" class="col-md-4 control-label">Telefono</label>

                            <div class="col-md-6">
                                <input id="telefono" type="text" class="form-control" name="telefono" value="{{ old('telefono') }}">

                                @if ($errors->has('telefono'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
              <div class="form-group{{ $errors->has('fehainicio') ? ' has-error' : '' }}">
                            <label for="fechainicio" class="col-md-4 control-label">FechaInicio</label>

                            <div class="col-md-6">
                                <input id="fechainicio" type="date" class="form-control" name="fechainicio" value="{{ old('fechainicio') }}">

                                @if ($errors->has('fechainicio'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fechainicio') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group{{ $errors->has('fechafinal') ? ' has-error' : '' }}">
                            <label for="fechafinal" class="col-md-4 control-label">FechaFinal</label>

                            <div class="col-md-6">
                                <input id="fechafinal" type="date" class="form-control" name="fechafinal" value="{{ old('fechafinal') }}">

                                @if ($errors->has('fechafinal'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fechafinal') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       


             <div class="form-group{{ $errors->has('puesto') ? ' has-error' : '' }}">
                <label for="puesto" class="col-md-4 control-label">Puesto</label>
                <select name="puesto" class="form-control">
                <option value="cajero">Cajero</option>
                <option value="encargado">Encargado</option>
                <option value="gerente">Gerentes</option>
                <option value="bodeguero">Bodeguero</option>
                       
                </select>
            </div>
          
         <div class="form-group{{ $errors->has('idsucursal') ? ' has-error' : '' }}">
            <label for="idsucursal" class="col-md-4 control-label">Puesto</label>
            {!! Form::select('idsucursal', $sucursales, 0, array('class' => 'form-control input-sm mb15','idsucursal' => 'sucursales')) !!}
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label>Estado</label>
                <select name="estado" class="form-control">
                       <option value="Activo">Activo</option>
                       <option value="Inactivo">Inactivo</option>
                       
                </select>
            </div>
        </div>
            
                       

            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@push ('scripts')
<script>
$('#liAdministracion').addClass("treeview active");
$('#liEmpleados').addClass("active");
</script>
@endpush
@endsection