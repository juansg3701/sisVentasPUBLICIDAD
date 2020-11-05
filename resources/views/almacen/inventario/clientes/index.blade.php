@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Inventario - Stock</title>
    <!--importar jquery para el manejo de algunos campos del formulario-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>


<body>
	<div class="row">
		<div class="col-sm" align="center">
			<h2>PRODUCTOS STOCK</h2>
		</div>
	</div>

	<!--Código de JQuery para mostrar/esconder los campos de búsqueda-->


	<!--Formulario de opciones-->
	<div class="row" align="center">	
		<div class="col-sm-12" align="center">
			<div class="card" align="center"><br>
				<div class="row" align="center">	
					<div class="col-sm-3" align="center"></div>
						<div class="col-sm-6" align="center">
							<div class="card" align="center">
								
							
							</div>
						</div>
					<div class="col-sm-3" align="center"></div>
				</div><br>
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


<!--Tabla de registros realizados-->
<div class="card shadow mb-10">
    <div class="card-header py-3" align="center">
	    <h6 class="m-0 font-weight-bold">Lista de productos</h6>
    </div>
    <div class="card-body">
    	<div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<th>NOMBRE</th>
					<th>IMAGEN</th>
					<th>PLU</th>
					<th>EAN</th>
					<th>SEDE</th>
					<th>PROVEEDOR</th>
					<th>CLIENTE</th>
					<th>CATEGORÍA</th>
					<th>CANTIDAD</th>
					<th>VENCE</th>
					<th>ESTADO</th>
					<th colspan="3">OPCIONES</th>
				</thead>
				@foreach($productos as $ps)
		
				<tr>
					<td>{{ $ps->nombre}}</td>
					<td>
						<label>
							<a href="" title="Ver imagen" class="btn btn-light" data-target="#modal-infoImagen-{{$ps->id_stock}}" data-toggle="modal">
							<img src="{{asset('imagenes/articulos/'.$ps->img)}}" alt="{{ $ps->nombre}}" height="100px" width="100px" class="img-thumbnail"></a>
						</label>
					</td>
					<td>{{ $ps->plu}}</td>
					<td>{{ $ps->ean}}</td>
					<td>{{ $ps->nombre_sede}}</td>
					<td>{{ $ps->nombre_proveedor}}</td>

					@if($ps->cliente_id_cliente==0)
					<td>Sin cliente</td>
					@else
					@foreach($clientes as $c)
							@if($c->id_cliente==$ps->cliente_id_cliente)
					<td>{{$c->nombre}}</td>
					@endif
					@endforeach
					@endif

					<td>{{ $ps->categoria_id_categoria}}</td>
					<td>{{ $ps->cantidad}}</td>
					<td>{{ $ps->fecha_vencimiento}}</td>

					@if($ps->producto_dados_baja=='1')
						<td>Dado de baja</td>
					@endif
					@if($ps->producto_dados_baja=='0')
						<td>Disponible</td>
					@endif
				
					<td>					
						<a href="" title="Registro de cambios" class="btn btn-info btn-circle" data-target="#modal-infoStock-{{$ps->id_stock}}" data-toggle="modal"><i class="fas fa-info-circle"></i></a>
					</td>
				</tr>
				@include('almacen.inventario.proveedor-sede.modal')
				@include('almacen.inventario.proveedor-sede.modalInfoStock')
				@include('almacen.inventario.proveedor-sede.modalImagen')
		
				@endforeach
            </table>
		</div>
		{{$productos->render()}}
    </div>
</div>

@stop