@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Inventario - Productos sede</title>
</head>

<body>
	<div class="row">
		<div class="col-sm" align="center">
			<h2>PRODUCTOS</h2>
		</div>
	</div>

	<div class="row" align="center">	
		<div class="col-sm-12" align="center">
			<div class="card" align="center"><br>

		<div id=formulario>
			<div class="form-group">
				@include('almacen.inventario.producto-sede.productoCompleto.search')
			<br><br>
			<div align="center">
				<a href="{{URL::action('ProductoSedeController@create',0)}}"><button class="btn btn-info">Registrar producto</button></a>
				<a href="{{URL::action('ImpuestoProducto@index',0)}}"><button class="btn btn-info">Registrar impuesto</button></a>
				<a href="{{URL::action('CategoriaProducto@index',0)}}"><button class="btn btn-info">Registrar categoria</button></a>
				<button class="btn btn-success">Cargar xls</button>
				<button class="btn btn-success">Descargar xls</button>
				<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
				<br><br>
			</div>
			</div>
		</div>

	</div>
		</div>
	</div>
</body>

@stop
@section('tabla')

<div class="container-fluid"><br>
	<div class="col-sm-12" align="center">
		<div class="col-sm-6" align="center">
			<h1 class="h3 mb-2 text-gray-800">PRODUCTOS REGISTRADOS</h1>
		</div>
	</div><br>
</div>

<div class="card shadow mb-10">
    <div class="card-header py-3" align="center">
	    <h6 class="m-0 font-weight-bold">Lista de productos</h6>
    </div>
    <div class="card-body">
    	<div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<!--<th>ID</th>-->
					<th>NOMBRE</th>
					<th>PLU</th>
					<th>EAN</th>
					<th>CATEGORÍA</th>
					<th>PRECIO</th>
					<th>IMPUESTO</th>
					<th>STOCK MÍNIMO</th>
					<th>IMAGEN</th>
					<th>OPCIONES</th>
				</thead>
				@foreach($productos as $ps)
				<tr>
					<!--<td>{{ $ps->id_producto}}</td>-->
					<td>{{ $ps->nombre}}</td>
					<td>{{ $ps->plu}}</td>
					<td>{{ $ps->ean}}</td>
					<td>{{ $ps->categoria_id_categoria}}</td>
					<td>{{ $ps->precio}}</td>
					<td>{{ $ps->impuestos_id_impuestos}}</td>
					<td>{{ $ps->stock_minimo}}</td>
					<td>
						<label>
							<img src="{{asset('imagenes/articulos/'.$ps->imagen)}}" alt="{{ $ps->nombre}}" height="100px" width="100px" class="img-thumbnail">
						</label>
					</td>
					<td>
						<a href="{{URL::action('ProductoSedeController@edit',$ps->id_producto)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$ps->id_producto}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('almacen.inventario.producto-sede.productoCompleto.modal')
				@endforeach
            </table>
		</div>
		{{$productos->render()}}
    </div>
</div>

@stop