@extends ('layouts.admin')
@section ('contenido')
<head>
	<title>Pedidos</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->

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

	<div class="row" align="center">	
		<div class="col-sm-12" align="center">
			<div class="card" align="center">

				<div class="row" align="center">
					<div class="col-sm-12" align="center">
						<br><h1 class="h3 mb-2 text-gray-800">PRODUCTOS DE PEDIDO-CLIENTE</h1><br>
					</div>
				</div>

				<div class="row" align="center">
					<div class="col-sm-12" align="center">
						<a href="{{url('almacen/facturacion/listaPedidosClientes')}}" class="btn btn-danger">Regresar</a><br><br>
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
			
		</div>
	</div><br>
</div>

<!--Tabla de registros realizados en la tabla de pedidos en la base de datos-->	
<div class="card shadow mb-10">
    <div class="card-header py-3" align="center">
	    <h6 class="m-0 font-weight-bold">Lista de productos</h6>
    </div>
    <div class="card-body">
    	<div class="table-responsive">

			@foreach($pedidoCliente as $pc)
			@if($pc->id_remision==$id)
				@if($pc->finalizar=='1')
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<th>NO. REMISI&Oacute;N</th>
						<th>PRODUCTO</th>
						<th>CANTIDAD</th>
					</thead>
					@foreach($detalleCliente as $pc)
					<tr>
						<td>{{$pc->t_p_cliente_id_remision}}</td>
						<td>{{$pc->producto_id_producto}}</td>
						<td>{{$pc->cantidad}}</td>
					</tr>
					@endforeach
				</table>
				@else
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<th>NO. REMISI&Oacute;N</th>	
						<th>PRODUCTO</th>
						<th>CANTIDAD</th>
					</thead>
					@foreach($detalleCliente as $pc)
					<tr>
						<td>{{$pc->t_p_cliente_id_remision}}</td>			
						<td>{{$pc->producto_id_producto}}</td>
						<td>{{$pc->cantidad}}</td>
					</tr>
					@endforeach
				</table>
				@endif
			@endif
		@endforeach

        </div>
        {{$detalleCliente->render()}}
	</div>
</div>

<div>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>	
</div>
@endsection