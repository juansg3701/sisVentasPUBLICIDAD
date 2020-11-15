@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Editar Proveedor</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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

	<!--Código de JQuery para mostrar/esconder los campos del atributo documento-->
	<script type="text/javascript">
		$( function() {
    		$("#id_tipo_documento").change( function() {
	       	 	if ($(this).val() === "1") {
	            	$("#id_cedula").prop("disabled", false);
	            	$("#id_falso").prop("disabled", false);
	        	} else {
	            	$("#id_cedula").prop("disabled", true);
	            	$("#id_falso").prop("disabled", true);
	        	}
	        	if ($(this).val() === "2") {
	            	$("#id_nit").prop("disabled", false);
	            	$("#id_digito").prop("disabled", false);
	        	} else {
	            	$("#id_nit").prop("disabled", true);
	            	$("#id_digito").prop("disabled", true);
	        	}
    		});
		});
	</script>

	{!!Form::model($proveedor,['method'=>'PATCH','route'=>['almacen.proveedor.update',$proveedor->id_proveedor]])!!}
	{{Form::token()}}

    <!--Formulario de edición-->	
	<div class="col-md-12">
		<div class="card"><br>
			<div  class="col-sm-12" align="center">
				<h3 class="pb-2 display-5">EDITAR PROVEEDOR</h3>
			</div>
			<div class="col-sm-12" align="center">
				Editar datos de: {{$proveedor->nombre_empresa}}<br><br>
			</div>
			<div class="row" align="center">	
				<div class="col-sm-3" align="center"></div>
				 	<div class="col-sm-6" align="center">
						<div class="card" align="center">
			                <div class="card-header" align="center">
			                     <strong>Formulario de edición</strong>
			                </div><br>
			                <div class="card-body card-block" align="center">
			                	
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Nombre empresa:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="nombre_empresa" value="{{$proveedor->nombre_empresa}}">
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Contacto:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="nombre_proveedor" value="{{$proveedor->nombre_proveedor}}">
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Direcci&oacute;n:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="direccion" value="{{$proveedor->direccion}}">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Correo:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="email" class="form-control" name="correo" value="{{$proveedor->correo}}">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Tel&eacute;fono:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="number" class="form-control" name="telefono" value="{{$proveedor->telefono}}">
									</div>
								</div>
						
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>NIT:</div>
									</div>
									<div class="form-group col-sm-6">
										<input type="number" class="form-control" name="documento" placeholder="- - - - - - -" min="0" value="{{$proveedor->documento}}">
									</div>
									<div class="form-group col-sm-2">		
										<input type="number"  class="form-control" name="verificacion_nit" placeholder="-" min="0" max="9" value="{{$proveedor->verificacion_nit}}">
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Fecha:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="datetime" name="" value="<?php echo date("Y/m/d"); ?>" class="form-control" disabled="true">
										<input type="hidden" name="fecha" value="<?php echo date("Y/m/d"); ?>" class="form-control">
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Empleado:</div>
									</div>
									<div class="form-group col-sm-8">
										<select name="" class="form-control" disabled="true">
											@foreach($usuarios as $usu)
											@if(Auth::user()->id==$usu->user_id_user)
											<option value="{{$usu->id_empleado}}">{{$usu->nombre}}</option>
											<input type="hidden" name="empleado_id_empleado" value="{{$usu->id_empleado}}">
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
											<select name="sede_id_sede" class="form-control" disabled="true">
												@foreach($sedes as $s)
												@if( Auth::user()->sede_id_sede ==$s->id_sede)
												<option value="{{$s->id_sede}}" >{{$s->nombre_sede}}</option>
												<input type="hidden" name="sede_id_sede" value="{{$s->id_sede}}">
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
	
{!!Form::close()!!}		
</body>
@stop