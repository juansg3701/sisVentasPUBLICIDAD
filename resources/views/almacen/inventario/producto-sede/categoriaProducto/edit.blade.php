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

	{!!Form::model($categoria,['method'=>'PATCH','route'=>['almacen.inventario.producto-sede.categoriaProducto.update',$categoria->id_categoria]])!!}
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