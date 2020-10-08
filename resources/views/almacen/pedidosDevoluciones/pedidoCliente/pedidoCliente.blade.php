@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Pedidos</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->

</head>
<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Pedido cliente-almacen</h3>
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

	{!!Form::open(array('url'=>'almacen/facturacion/listaPedidosClientes','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

	<div id=formulario>
		<select style="visibility:hidden"name="tipo_pago_id_tpago" class="form-control">
			@foreach($tipoPagos as $tp)
			<option value="{{$tp->id_tpago}}">{{$tp->nombre}}</option>
			@endforeach
		</select>
		Fecha de solicitud:<input type="datetime-local" class="form-control" name="fecha_solicitud"  value="<?php echo date("Y/m/d H:i"); ?>" readonly>
		Fecha de entrega:<input type="date" class="form-control" name="fecha_entrega" >
		<input type="hidden" class="form-control" name="noproductos" >
		
	
		<input type="hidden" class="form-control" name="pago_inicial">
		<input type="hidden" class="form-control" name="porcentaje_venta">
		Cliente:
		<select name="cliente_id_cliente" class="form-control">
			@foreach($clientes as $cli)
			<option value="{{$cli->id_cliente}}">{{$cli->nombre}}</option>
			@endforeach
		</select>
		Empleado:
		<select name="empleado_id_empleado" class="form-control">
			@foreach($usuarios as $usu)
			<option value="{{$usu->id_empleado}}">{{$usu->nombre}}</option>
			@endforeach
		</select>
		<input type="hidden" class="form-control" name="pago_total">

			<br>
			<div align="center">
			<button class="btn btn-info" type="submit">Registrar</button>
			<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
			</div>
			<br>
		</div>
	</div>

{!!Form::close()!!}	

			<!--<a href="{{URL::action('productoPedidoCliente@index',0)}}">
			<button class="btn btn-info">Registrar productos</button></a>-->
			<a href="{{URL::action('facturacionListaPedidosClientes@index',0)}}">
			<button class="btn btn-info">Ver pedidos</button></a>

</body>

@stop