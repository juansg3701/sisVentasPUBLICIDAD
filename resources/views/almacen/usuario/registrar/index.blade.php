@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Usuario</title>
</head>

<body>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>


	{!!Form::open(array('url'=>'almacen/usuario/registrar','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
    {{Form::token()}}
      <!--Formulario de registro-->	
	<div class="col-md-12">
		<div class="card">
			<div class="card-header" align="center">
				<h3 class="pb-2 display-5">REGISTRAR USUARIO</h3>
			</div><br>
			<div class="row" align="center">	
				<div class="col-sm-3" align="center"></div>
				 	<div class="col-sm-6" align="center">
						<div class="card" align="center">
			                <div class="card-header" align="center">
			                     <strong>Formulario de registro</strong>
			                </div><br>
			                <div class="card-body card-block" align="center">

			                	<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
			                		<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Nombre:</div>
									</div>
									<div class="form-group col-sm-8">
										<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

		                                @if ($errors->has('name'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('name') }}</strong>
		                                    </span>
		                                @endif
									</div>
										</div>
                       			 </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        	<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Correo:</div>
									</div>
									<div class="form-group col-sm-8">
										<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

		                                @if ($errors->has('email'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('email') }}</strong>
		                                    </span>
		                                @endif
									</div>
								</div>
                                
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                        	<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Contrase&ntilde;a:</div>
									</div>
									<div class="form-group col-sm-8">
										<input id="password" type="password" class="form-control" name="password">

		                                @if ($errors->has('password'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('password') }}</strong>
		                                    </span>
		                                @endif
									</div>
								</div>
                        </div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>C&oacute;digo:</div>
									</div>
									<div class="form-group col-sm-8">
										
										<input id="codigo" type="text" class="form-control" name="codigo">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Direcci&oacute;n:</div>
									</div>
									<div class="form-group col-sm-8">
										
										<input id="codigo" type="text" class="form-control" name="direccion">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Telefono:</div>
									</div>
									<div class="form-group col-sm-8">
										
										<input id="codigo" type="text" class="form-control" name="telefono">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Documento:</div>
									</div>
									<div class="form-group col-sm-8">
										
										<input id="codigo" type="text" class="form-control" name="documento">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Cargo:</div>
									</div>
									<div class="form-group col-sm-8">
										<select name="tipo_cargo_id_cargo" class="form-control">
											@foreach($cargos as $car)
											@if($car->id_cargo!=4 && $car->id_cargo!=3)
											<option value="{{$car->id_cargo}}">{{$car->nombre}}</option>
											@endif
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Sede:</div>
									</div>
									<div class="form-group col-sm-8">
										<select name="sede_id_sede" class="form-control">
											@foreach($sedes as $sed)
											@if($sed->tipo_sede_id_tipo_sede==2)
											<option value="{{$sed->id_sede}}">
											@endif
											{{$sed->nombre_sede}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<input id="codigo" type="hidden" class="form-control" name="tipo_cuenta" value="0">
								@if(Auth::user()->superusuario==1)
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Superusuario:</div>
									</div>
									<div class="form-group col-sm-8">
										<select name="superusuario" class="form-control">
											
											<option value="0">Normal</option>
											<option value="1">Superusuario</option>
											
										</select>
									</div>
								</div>
								@else
								<input id="codigo" type="hidden" class="form-control" name="superusuario" value="0">
								@endif
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Fecha:</div>
										<input type="hidden" name="fecha" value="<?php echo date("Y/m/d"); ?>" class="form-control" disabled="true">
									</div>
									<div class="form-group col-sm-8">
										<input type="datetime" name="fecha" value="<?php echo date("Y/m/d"); ?>" class="form-control" readonly>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-12">
										<a href="usuario/iniciar/sesionIniciada"><button class="btn btn-info" type="submit">Registrar Usuario</button></a>
										<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
									</div>
								</div>
			               </div>
			        	</div>
					</div>
				<div class="col-sm-3" align="center"></div>
			</div>

		</div>
	</div>		                     

	{!!Form::close()!!}	
</body>

@stop


