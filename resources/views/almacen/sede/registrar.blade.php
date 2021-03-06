@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Sede</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
</head>
<body>
	<!--Control de errores en los campos del formulario-->	
	<div class="container col-sm-12" align="center">
		<div class="row" align="center">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				@if (count($errors)>0)
				<div class="alert alert-danger" align="center">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
				@endif
			</div>
		</div>
	</div>

	{!!Form::open(array('url'=>'almacen/sede','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

	<div class="row" align="center">	
		<div class="col-sm-12" align="center">
			<div class="card" align="center">
				<div class="row" align="center">
					<div class="col-sm-12" align="center">
						<br><h1 class="h3 mb-2 text-gray-800">REGISTRAR SEDE</h1><br>
					</div>
				</div>
				<div class="row" align="center">	
					<div class="col-sm-3" align="center"></div>
					 	<div class="col-sm-6" align="center">
							<div class="card" align="center">
				                <div class="card-header" align="center">
				                     <strong>Formulario de registro</strong>
				                </div>
				                <div class="card-body card-block" align="center">
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Nombre:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="text" class="form-control" name="nombre_sede">
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Ciudad:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="text" class="form-control" name="ciudad">
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Descripción:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="text" class="form-control" name="descripcion">
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Dirección:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="text" class="form-control" name="direccion">
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Teléfono:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="number" class="form-control" name="telefono">
										</div>
									</div>
									<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Tipos:</div>
									</div>
									<div class="form-group col-sm-8">
										<select name="tipo_sede_id_tipo_sede" class="form-control">
											@foreach($tipos as $t)
											<option value="{{$t->id_tipo_sede}}">{{$t->nombre}}</option>
											@endforeach
										</select>
									</div>
								</div>

									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Fecha:</div>
										</div>
										<input type="hidden" name="fecha" value="<?php echo date("Y/m/d"); ?>" class="form-control">
										<div class="form-group col-sm-8">
											<input type="datetime" name="fecha" value="<?php echo date("Y/m/d"); ?>" class="form-control" disabled="true">
										</div>
									</div>

									<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Empleado:</div>
									</div>
									<div class="form-group col-sm-8">
										<select name="empleado_id_empleado" class="form-control" disabled="">
											@foreach($empleados as $usu)
											@if(Auth::user()->id==$usu->user_id_user)
											<option value="{{$usu->id_empleado}}">{{$usu->nombre}}</option>
											<input type="hidden" name="empleado_id_empleado" value="{{$usu->id_empleado}}">
											@endif
											@endforeach
										</select><br>
									</div>
								</div>
									<div class="form-row">
										<div class="form-group col-sm-12">
											<button class="btn btn-info" type="submit">Registrar</button>
											<a href="{{url('almacen/sede')}}" class="btn btn-danger">Regresar</a>
										</div>
									</div>
				               </div>
				        	</div>
						</div>
					<div class="col-sm-3" align="center"></div>
				</div>
        	</div>
		</div>
	</div>
			                       
{!!Form::close()!!}		
</body>

@stop