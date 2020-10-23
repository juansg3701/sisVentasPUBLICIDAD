@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Editar producto</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
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

	{!!Form::model($productos,['method'=>'PATCH','route'=>['almacen.inventario.producto-sede.productoCompleto.update',$productos->id_producto], 'files'=>'true'])!!}
	{{Form::token()}}
	
	<div class="row" align="center">	
		<div class="col-sm-12" align="center">
			<div class="card" align="center">
				<div class="row" align="center">
					<div class="col-sm-12" align="center">
						<br><h1 class="h3 mb-2 text-gray-800">EDITAR PRODUCTOS</h1>
					</div>
					<div class="col-sm-12" align="center">
						Editar datos de: {{$productos->nombre}}<br>
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
											<input type="text" class="form-control" value="{{$productos->nombre}}" name="nombre" >
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>PLU:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="text" class="form-control" name="plu" value="{{$productos->plu}}">
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>EAN</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="text" class="form-control" name="ean" value="{{$productos->ean}}">
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Categoría</div>
										</div>
										<div class="form-group col-sm-8">
											<select name="categoria_id_categoria" class="form-control" value="{{$productos->categoria_id_categoria}}">
												@foreach($categorias as $ct)
												<option value="{{$ct->id_categoria}}">{{$ct->nombre}}</option>
												@endforeach
											</select>	
										</div>
									</div>

									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Precio</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="text" class="form-control" name="precio" value="{{$productos->precio}}">
										</div>
									</div>

									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Stock Mínimo</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="text" class="form-control" name="stock_minimo" value="{{$productos->stock_minimo}}">
										</div>
									</div>

									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Imagen:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="file" name="imagen" class="form-control" placeholder="">
										</div>

									</div>

									<div class="form-row">
										<div class="form-group col-sm-12">
										@if($productos->imagen!="")
											<img src="{{asset('imagenes/articulos/'.$productos->imagen)}}"  height="200px" width="200px" class="img-thumbnail">
										@endif
										</div>
									</div>


									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Fecha:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="datetime" name="fecha" value="<?php echo date("Y/m/d"); ?>" class="form-control">
										</div>
									</div>

									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Empleado:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="hidden" name="empleado_id_empleado" value="{{Auth::user()->id}}">

											<select name="" class="form-control" disabled="true">
												@foreach($usuarios as $usu)
												@if(Auth::user()->id==$usu->user_id_user)
												<option value="{{$usu->id_empleado}}">{{$usu->nombre}}</option>
												@endif
												@endforeach

												@foreach($usuarios as $usu)
												@if(Auth::user()->id!=$usu->user_id_user)
												<option value="{{$usu->id_empleado}}">{{$usu->nombre}}</option>
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
											<input type="hidden" name="sede_id_sede" value="{{Auth::user()->id}}">

											<select name="sede_id_sede" class="form-control" disabled="true">
												@foreach($sedes as $s)
												@if( Auth::user()->sede_id_sede ==$s->id_sede)
												<option value="{{$s->id_sede}}" >{{$s->nombre_sede}}</option>
												aa
												@endif
												@endforeach

												@foreach($sedes as $s)
												@if( Auth::user()->sede_id_sede!=$s->id_sede)
												<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
												aa
												@endif
												@endforeach
											</select><br>
										</div>
									</div>
									

									<div class="form-row">
										<div class="form-group col-sm-12">
											<button type="submit" class="btn btn-info">Guardar</button>
											<a href="{{url('almacen/inventario/producto-sede/productoCompleto')}}" class="btn btn-danger">Regresar</a>
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