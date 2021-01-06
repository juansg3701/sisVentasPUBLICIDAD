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

	{!!Form::open(array('url'=>'almacen/facturacion/listaPedidosClientes','method'=>'POST','autocomplete'=>'off'))!!}
	{{Form::token()}}
	
	<div class="row" align="center">	
		<div class="col-sm-12" align="center">
			<div class="card" align="center">

				<div class="row" align="center">
					<div class="col-sm-12" align="center">
						<br><h1 class="h3 mb-2 text-gray-800">REGISTRAR PEDIDO CLIENTE</h1><br>
					</div>
				</div>

				<div class="row" align="center">	
					<div class="col-sm-3" align="center"></div>
					 	<div class="col-sm-6" align="center">
							<div class="card" align="center">
				                <div class="card-header" align="center">
				                     <strong>Formulario de registro</strong>
				                </div>
				                <div class="card-body card-block" align="center">

									<select style="visibility:hidden"name="tipo_pago_id_tpago" class="form-control">
										@foreach($tipoPagos as $tp)
										<option value="{{$tp->id_tpago}}">{{$tp->nombre}}</option>
										@endforeach
									</select>
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Fecha de solicitud:</div>
										</div>
										<div class="form-group col-sm-8">
											
											<input type="datetime" name="" value="<?php echo date("Y/m/d H:i"); ?>" class="form-control" disabled="true">
											<input type="hidden" name="fecha_solicitud" value="<?php echo date("Y/m/d H:i"); ?>" class="form-control">
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Fecha de entrega:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="date" class="form-control" name="fecha_entrega" >
											<input type="hidden" class="form-control" name="noproductos" >
											<input type="hidden" class="form-control" name="pago_inicial">
											<input type="hidden" class="form-control" name="porcentaje_venta">
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Cliente:</div>
										</div>
										<div class="form-group col-sm-8">
											<select name="cliente_id_cliente" class="form-control">
												@foreach($clientes as $cli)
												<option value="{{$cli->id_cliente}}">{{$cli->nombre}}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Empleado:</div>
										</div>
										<div class="form-group col-sm-8">
											<select name="empleado_id_empleado" class="form-control" disabled="">
												@foreach($empleados as $usu)
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
											<div class="form-group col-sm-4">
												<div></div>
											</div>
											<div class="form-group col-sm-8">
												<input type="hidden" class="form-control" name="finalizar" value="0">
											</div>
									</div>
									
									<div class="form-row">
										<div class="form-group col-sm-12">
											<button class="btn btn-info" type="submit">Registrar</button>
											<a href="{{URL::action('facturacionListaPedidosClientes@index',0)}}" class="btn btn-danger">Regresar</a>
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