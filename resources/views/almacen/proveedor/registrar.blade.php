@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Proveedor-Registrar</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
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
	{!!Form::open(array('url'=>'almacen/proveedor','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    		<div class="row" align="center">	
		<div class="col-sm-12" align="center">
			<div class="card" align="center">
				<div class="row" align="center">
					<div class="col-sm-12" align="center">
						<br><h1 class="text-center title-1">Registrar Proveedor</h1><br>
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
											<div>Nombre empresa:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="text" class="form-control" name="nombre_empresa">
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Contacto empresa:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="text" class="form-control" name="nombre_proveedor">
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
											<div>Correo:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="email" class="form-control" name="correo">
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
											<div>NIT:</div>
										</div>
										<div class="form-group col-sm-6">
											<input type="number" class="form-control" name="documento" placeholder="- - - - - - -" min="0">
										</div>
										<div class="form-group col-sm-2">		
											<input type="number" class="form-control" name="verificacion_nit" placeholder="-" min="0" max="9">
										</div>
									</div>

									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Fecha:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="datetime" name="fecha" value="<?php echo date("Y/m/d"); ?>" class="form-control" readonly>
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
											<a href="{{url('almacen/proveedor')}}" class="btn btn-danger">Regresar</a>
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