@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Categoria stock - Días especiales</title>
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

	<div class="row">
		<div class="col-sm" align="center">
			<h2>CATEGORÍA STOCK - DÍAS ESPECIALES</h2>
		</div>
	</div>

	{!!Form::open(array('url'=>'almacen/inventario/categoriaStock','method'=>'POST','autocomplete'=>'off'))!!}
	{{Form::token()}}
	
	<div class="row" align="center">	
		<div class="col-sm-12" align="center">
			<div class="card" align="center">
				<div class="row" align="center">	
					<div class="col-sm-3" align="center"></div>
					 	<div class="col-sm-6" align="center"><br>
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
											<input type="text" class="form-control" name="nombre">
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
											<a href="{{URL::action('CategoriaProducto@create',0)}}"><button href="" class="btn btn-info" type="submit">Registrar</button></a>
											<a href="{{url('almacen/inventario/producto-sede/productoCompleto')}}" class="btn btn-danger">Regresar</a>
										</div>
									</div>
				               </div>
				        	</div>
						</div>
					<div class="col-sm-3" align="center"></div>
				</div><br>
        	</div>
		</div>
	</div>
	{!!Form::close()!!}	
</body>
@stop

@section('tabla')


<div class="container-fluid"><br>
	<div class="col-sm-12" align="center">
		<div class="col-sm-6" align="center">
			<h1 class="h3 mb-2 text-gray-800">CATEGORÍAS REGISTRADAS</h1>
		</div>
	</div><br>
</div>
<div class="form-group col-sm">
	@include('almacen.inventario.categoriaStock.search')	
</div>
<div class="card shadow mb-10">
    <div class="card-header py-3" align="center">
	    <h6 class="m-0 font-weight-bold">Lista de categorías</h6>
    </div>
    <div class="card-body">
    	<div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<th>NOMBRE</th>
					<th>DESCRIPCIÓN</th>
					<th colspan="3">OPCIONES</th>
				</thead>
				@foreach($categorias as $cat)
				<tr>
					<td>{{ $cat->nombre}}</td>
					<td>{{ $cat->descripcion}}</td>
					<td>
						<a href="{{URL::action('CategoriaStockController@edit',$cat->id_categoriaStock)}}" title="Editar" class="btn btn-success btn-circle"><i class="fas fa-check"></i></a>
					</td>
					<td>
						<a href="" data-target="#modal-delete-{{$cat->id_categoriaStock}}" title="Eliminar" class="btn btn-danger btn-circle" data-toggle="modal"><i class="fas fa-trash"></i></a>
					</td>
					<td>					
						<a href="" title="Registro de cambios" class="btn btn-info btn-circle" data-target="#modal-infoCategoria-{{$cat->id_categoriaStock}}" data-toggle="modal"><i class="fas fa-info-circle"></i></a>
					</td>

				</tr>
				@include('almacen.inventario.categoriaStock.modal')
				@include('almacen.inventario.categoriaStock.modalInfoCategoria')
				@endforeach
            </table>
		</div>
		{{$categorias->render()}}
    </div>
</div>
@stop