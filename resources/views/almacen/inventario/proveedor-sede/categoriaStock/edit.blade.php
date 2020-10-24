@extends ('layouts.admin')
@section ('contenido')

<head>
	<title>Editar categoria producto</title>
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

	{!!Form::model($categoria,['method'=>'PATCH','route'=>['almacen.inventario.producto-proveedor.categoriaStock.update',$categoria->id_categoria]])!!}
	{{Form::token()}}
	
	<div class="row" align="center">	
		<div class="col-sm-12" align="center">
			<div class="card" align="center">
				<div class="row" align="center">
					<div class="col-sm-12" align="center">
						<br><h1 class="h3 mb-2 text-gray-800">EDITAR PRODUCTOS</h1>
					</div>
					<div class="col-sm-12" align="center">
						Editar datos de: {{$categoria->nombre}}<br>
					</div>
				</div><br>
				<div class="row" align="center">	
					<div class="col-sm-3" align="center"></div>
					 	<div class="col-sm-6" align="center">
							<div class="card" align="center">
				                <div class="card-header" align="center">
				                     <strong>Formulario de edición</strong>
				                </div>
				                <div class="card-body card-block" align="center">
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Nombre:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="text" class="form-control" value="{{$categoria->nombre}}" name="nombre">
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Descripción:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="text" class="form-control" value="{{$categoria->descripcion}}" name="descripcion">
										</div>
									</div>

									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Fecha:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="datetime" name="fecha" value="<?php echo date("Y/m/d"); ?>" class="form-control" disabled="true">
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
											<a href="{{url('almacen/inventario/producto-sede/categoriaProducto')}}" class="btn btn-danger">Regresar</a>
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