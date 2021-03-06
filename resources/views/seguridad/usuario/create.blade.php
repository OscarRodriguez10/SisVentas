
@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Usuario</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'seguridad/usuario','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
            <div class="panel panel-primary">
            <div class="panel-body">
    
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                
          
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                 <div class="form-group">
                    <label>Sucursales</label>
                    
                    <select name="pidsucursal" class="form-control selectpicker" id="pidsucursal" data-live-search="true">
                    
                    @foreach($sucursales as $suc)
                    <option  value="{{$suc->idsucursal}}_{{$suc->nombre}}"> {{$suc->nombre}}  </option>
                     @endforeach
                        </select>   
                    </div>
                </div>
        
            <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                 <div class="form-group">
                    <label>Empleados</label>
                    
                    <select name="idempleado" class="form-control selectpicker" id="idempleado" data-live-search="true">
                    
                    @foreach($empleados as $emp)
                    <option  value="{{$emp->idempleado}}_{{$emp->nombre}}"> {{$emp->nombre}}  </option>
                     @endforeach
                        </select>   
                    </div>
                </div>
           <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                 <div class="form-group">
                    <label>TipoUsuario</label>
                    
                    <select name="pidtipousuario" class="form-control selectpicker" id="pidtipousuario" data-live-search="true">
                    
                    @foreach($tipousuario as $tipo)
                    <option  value="{{$tipo->idtipo}}_{{$tipo->descripcion}}"> {{$tipo->descripcion}}  </option>
                     @endforeach
                        </select>   
                    </div>
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
        </div>
    </div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@push ('scripts')
<script>
$('#liAcceso').addClass("treeview active");
$('#liUsuarios').addClass("active");
</script>
@endpush
@endsection