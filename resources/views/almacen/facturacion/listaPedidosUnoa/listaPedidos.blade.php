@extends ('layouts.admin')
@section ('contenido')
	<head>
	<title>Facturación</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
</head>

<body>

	<div class="row">
		<div class="col-sm" align="center">
			<h2>PEDIDOS UNOA</h2>
		</div>
	</div>

	<div class="row" align="center">	
		<div class="col-sm-3" align="center"></div>
			<div class="col-sm-6" align="center">
				<div class="card" align="center">
				   <div class="card-header" align="center">
				    	<strong></strong>
				    </div>
				    <div class="card-body card-block" align="center">
						<div id=formulario>
							<div class="form-group">			
								<div  align="center">
									<a href="{{URL::action('facturacionListaPedidosUnoa@show',0)}}">
									<button class="btn btn-info">Nuevo pedido</button></a>
									<a href="{{url('/')}}" class="btn btn-danger">Regresar</a>
								</div>
							</div>
						</div>
				    </div>
				</div>
			</div>
		<div class="col-sm-3" align="center"></div>
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
	@include('almacen.facturacion.listaPedidosUnoa.search')
</div>

<!--Tabla de registros realizados en la tabla de pedidos en la base de datos-->	
<div class="card shadow mb-10">
    <div class="card-header py-3" align="center">
	    <h6 class="m-0 font-weight-bold">Lista de pedidos</h6>
    </div>
    <div class="card-body">
    	<div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<th>NO. REMISI&Oacute;N</th>
					<th>NO. PRODUCTOS</th>
					<th>FECHA SOLICITUD</th>
					<th>FECHA ENTREGA</th>
					
					<th>EMPLEADO</th>
					<th>TOTAL</th>
					<th colspan="2">OPCIONES</th>
				</thead>
				@foreach($pedidosCliente as $pc)
				<tr>
					<td>{{$pc->id_remision}}</td>
					<td>{{$pc->noproductos}}</td>
					<td>{{$pc->fecha_solicitud}}</td>
					<td>{{$pc->fecha_entrega}}</td>
					
					<td>{{$pc->empleado}}</td>
					<td>{{$pc->pago_total}}</td>
					<td>	
						<a href="{{URL::action('facturacionListaPedidosUnoa@edit',$pc->id_remision)}}"><button class="btn btn-info">Productos</button></a>
					</td>
					<td>
						<a href="" data-target="#modal-delete-{{$pc->id_remision}}" title="Eliminar" class="btn btn-danger btn-circle" data-toggle="modal"><i class="fas fa-trash"></i></a>
					</td>
				</tr>
				@include('almacen.facturacion.listaPedidosUnoA.modal')
				@endforeach
            </table>
        </div>
        {{$pedidosCliente->render()}}
    </div>
</div>
@endsection

