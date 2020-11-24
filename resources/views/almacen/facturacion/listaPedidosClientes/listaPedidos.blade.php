@extends ('layouts.admin')
@section ('contenido')
	<head>
	<title>Facturación - Pedidos Cliente</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
</head>

<body>

	<div class="row">
		<div class="col-sm" align="center">
			<h2>PEDIDOS</h2>
		</div>
	</div>

	@include('almacen.facturacion.listaPedidosClientes.search')
	<div id=formulario>
		<div class="form-group">
			
			<div align="center">
			
				<a href="{{URL::action('facturacionListaPedidosClientes@show',0)}}">
				<button class="btn btn-info">Nuevo pedido</button></a>
				<a href="{{URL::action('facturacionListaPedidosClientes@show',0)}}" class="btn btn-danger">Volver</a>
				</div>
				<br>
			
		</div>
	</div>
</body>
@stop


@section('tabla')
<div class="container-fluid"><br>
	<div class="col-sm-12" align="center">
		<div class="col-sm-6" align="center">
			<h1 class="h3 mb-2 text-gray-800">PEDIDOS REGISTRADOS</h1>
		</div>
	</div><br>
</div>

<div class="form-group col-sm">
	<!--Incluir la ventana modal de búsqueda-->	
	@include('almacen.sede.search')
</div>

<!--Tabla de registros realizados en la tabla de proveedor en la base de datos-->	
<div class="card shadow mb-10">
    <div class="card-header py-3" align="center">
	    <h6 class="m-0 font-weight-bold">Lista de pedidos</h6>
    </div>
    <div class="card-body">
    	<div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<th>Remisión</th>
					<th>No. Productos</th>
					<th>Fecha de Solicitud</th>
					<th>Fecha de entrega</th>
					<th>Cliente</th>
					<th>Empleado</th>
					<th>Método de Pago</th>
					<th>Total</th>
					<th>Opciones</th>
				</thead>
				@foreach($pedidosCliente as $pc)
				<tr>
					<td>{{$pc->id_remision}}</td>
					<td>{{$pc->noproductos}}</td>
					<td>{{$pc->fecha_solicitud}}</td>
					<td>{{$pc->fecha_entrega}}</td>
					<td>{{$pc->cliente}}</td>
					<td>{{$pc->empleado}}</td>
					<td>{{$pc->tipo_pago}}</td>
					<td>{{$pc->pago_total}}</td>

					<td>
								<a href="{{URL::action('AbonoPCController@edit',$pc->id_remision)}}"><button class="btn btn-info">Abonos</button></a>
								<a href="{{URL::action('facturacionListaPedidosClientes@edit',$pc->id_remision)}}"><button class="btn btn-info">Productos</button></a>
								<a href="" data-target="#modal-delete-{{$pc->id_remision}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>


					<!--<td>	
						<a href="{{URL::action('SedeController@edit',$sed->id_sede)}}" title="Editar" class="btn btn-success btn-circle"><i class="fas fa-check"></i></a>
					</td>
					<td>

						<a href="" data-target="#modal-delete-{{$sed->id_sede}}" title="Eliminar" class="btn btn-danger btn-circle" data-toggle="modal"><i class="fas fa-trash"></i></a>
		
					</td>
					<td>					
						<a href="" title="Registro de cambios" class="btn btn-info btn-circle" data-target="#modal-infoSede-{{$sed->id_sede}}" data-toggle="modal"><i class="fas fa-info-circle"></i></a>
					</td>-->
				</tr>
				@include('almacen.facturacion.listaPedidosClientes.modal')
				@endforeach
            </table>
        </div>
        {{$pedidosCliente->render()}}
    </div>
</div>

@endsection