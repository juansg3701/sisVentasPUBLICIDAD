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
						<br><h1 class="h3 mb-2 text-gray-800">REGISTRAR PRODUCTOS DEL PEDIDO</h1><br>
					</div>
				</div>

				<div class="row" align="center">	
					<div class="col-sm-3" align="center"></div>
					 	<div class="col-sm-6" align="center">
							<div class="card" align="center">
				                <div class="card-header" align="center">
				                     <strong>Formulario de registro</strong>
								</div>

								{!! Form::open(array('url'=>'almacen/pedidosDevoluciones/productoPedidoUnoa','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}	
								<div class="card-body card-block" align="center">
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>EAN:</div>
										</div>
										<div class="form-group col-sm-8">
											<input id="tags" class="form-control" name="searchText" placeholder="Buscar...">
											<input type="hidden" class="form-control" name="t_p_proveedor_id_remision" value="{{$id}}">
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Nombre:</div>
										</div>
										<div class="form-group col-sm-8">
											<input id="buscar2" class="form-control" name="searchText1" placeholder="Buscar..." >
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-12">
											<div><input type="submit" class="btn btn-primary" value="Buscar"></div>
										</div>
									</div>
								</div>
								{{Form::close()}}

								{!!Form::open(array('url'=>'almacen/pedidosDevoluciones/productoPedidoUnoa','method'=>'POST','autocomplete'=>'off'))!!}
								{{Form::token()}}
								<div class="card-body card-block" align="center">
									<div class="form-row">
										<div class="form-group col-sm-12">
											<div>No. Remisión:  {{$id}}</div>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-12">
											<input type="hidden" class="form-control" name="t_p_proveedor_id_remision" value="{{$id}}"><br>
										</div>
									</div>
											<?php
												$Enable="disabled";
											?>
											<?php
												$Enable="disabled";
											?>
											<?php 
												$contador=0;
												$contador2=0;
												$contadorB=0;
												$contadorB2=0;
												$sedeP=auth()->user()->sede_id_sede;
												$conteoProductos1=count($productosEAN);
												$conteoProductos2=count($productosEAN2);
												$nombre="";
											?>

											@if($conteoProductos1!=0)
												
												@foreach($productosEAN as $EAN)

												@if($contador2=='0')
												<?php 
												$contador2=1;
												?>
												@endif


						
											
												<?php 
												$contador=1;
												?>

												<div class="form-row">
													<div class="form-group col-sm-4">
														<div>Nombre Producto:</div>
													</div>
													<div class="form-group col-sm-8">
														<input type="text" class="form-control" name="nombre" value="{{$EAN->nombre}}" disabled>
														<input type="hidden" class="form-control" name="producto_id_producto" value="{{$EAN->id_producto}}" enable>
													</div>
												</div>

												<div class="form-row">
													<div class="form-group col-sm-4">
														<div>Precio unitario:</div>
													</div>
													<div class="form-group col-sm-8">
														<input type="text" class="form-control" name="" value="{{$EAN->precio}}" disabled>
														<input type="hidden" class="form-control" name="precio_venta" value="{{$EAN->precio}}" enable>
													</div>
												</div>

												

												@if($EAN->nombre!='')
													<?php
													$Enable="enable";
													?>	
												@endif
												
												
												@endforeach
											@endif

											@if($searchText1!="")

												@foreach($productosEAN2 as $EAN)

													@if($contadorB2=='0')
													<?php 
													$contadorB2=1;
													?>
													@endif

													<div class="form-row">
														<div class="form-group col-sm-4">
															<div>Nombre Producto2:</div>
														</div>
														<div class="form-group col-sm-8">
															<input type="text" class="form-control" name="nombre" value="{{$EAN->nombre}}" disabled>
															<input type="hidden" class="form-control" name="producto_id_producto" value="{{$EAN->id_producto}}" enable>
														</div>
													</div>

													<div class="form-row">
														<div class="form-group col-sm-4">
															<div>Precio unitario2:</div>
														</div>
														<div class="form-group col-sm-8">
															<input type="text" class="form-control" name="" value="{{$EAN->precio}}" disabled>
															<input type="hidden" class="form-control" name="precio_venta" value="{{$EAN->precio}}" enable>
														</div>
													</div>

												
													@if($EAN->nombre!='')
														<?php
														$Enable="enable";
														?>	
													@endif
												
												
												@endforeach
											@endif

											
											@if($searchText!="" && $contadorB!='1' && $contador!='1')
											<script >
												window.alert("Producto no disponible");
											</script>
											@endif

	
									<div class="form-row">
											<div class="form-group col-sm-4">
												<div>Cantidad:</div>
											</div>
											<div class="form-group col-sm-8">
												<input type="text" class="form-control" name="cantidad" value="1">
											</div>
									</div>

									<div class="form-row">
											<div class="form-group col-sm-4">
												<div>Proveedor:</div>
											</div>
											<div class="form-group col-sm-8">
												<select name="proveedor_id_proveedor" class="form-control">
													@foreach($proveedor as $pro)
														<option value="{{$pro->id_proveedor}}">{{$pro->nombre_empresa}}</option>
													@endforeach
												</select>
											</div>
									</div>


									<div class="form-row">
											<div class="form-group col-sm-4">
												<div>Fecha:</div>
											</div>
											<div class="form-group col-sm-8">
												
												<input type="datetime" name="" value="<?php echo date("Y/m/d H:i"); ?>" class="form-control" disabled="true">
												<input type="hidden" name="fecha" value="<?php echo date("Y/m/d H:i"); ?>" class="form-control">
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

									@foreach($pedidoCliente as $pc)
										@if($pc->id_remision==$id)
											@if($pc->finalizar=='1')
											<div class="form-row">
												<div class="form-group col-sm-12">
													<button class="btn btn-info" type="submit" disabled>Registrar</button>
													<a href="{{url('almacen/facturacion/listaPedidosUnoa')}}" class="btn btn-danger">Regresar</a>
												</div>
											</div>
											@else
											<div class="form-row">
												<div class="form-group col-sm-12">
													<button class="btn btn-info" type="submit">Registrar</button>
													<a href="{{url('almacen/facturacion/listaPedidosUnoa')}}" class="btn btn-danger">Regresar</a>
												</div>
											</div>
											@endif
										@endif
									@endforeach
								</div>
							   {!!Form::close()!!}
				        	</div>
						</div>
					<div class="col-sm-3" align="center"></div>
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
			<h1 class="h3 mb-2 text-gray-800">PRODUCTOS DE PEDIDO REGISTRADOS</h1>
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
						<th>ID</th>
						<th>PRODUCTO</th>
						<th>PROVEEDOR</th>
						<th>CANTIDAD</th>
						<th>PRECIO UNITARIO</th>
						<th>TOTAL</th>
						<th>OPCIONES</th>		
					</thead>
					@foreach($detalleCliente as $pc)
					<tr>
						<td>{{$pc->t_p_proveedor_id_remision}}</td>
						<td>{{$pc->id_dpproveedor}}</td>
						<td>{{$pc->producto_id_producto}}</td>
						<td>{{$pc->proveedor_id_proveedor}}</td>
						<td>{{$pc->cantidad}}</td>
						<td>{{$pc->precio_venta}}</td>
						<td>{{$pc->total}}</td>
						<td>	
							<a href="" title="Registro de cambios" class="btn btn-info btn-circle" data-target="#modal-infoPedidoCliente-{{$pc->id_dpproveedor}}" data-toggle="modal"><i class="fas fa-info-circle"></i></a>
						</td>
					</tr>
					@include('almacen.pedidosDevoluciones.productoPedidoUnoa.modalInfoPedidoCliente')
					@endforeach
				</table>
				@else
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<th>NO. REMISI&Oacute;N</th>
						<th>ID</th>
						<th>PRODUCTO</th>
						<th>PROVEEDOR</th>
						<th>CANTIDAD</th>
						<th>PRECIO UNITARIO</th>
						<th>TOTAL</th>
						<th colspan="2">OPCIONES</th>
					</thead>
					@foreach($detalleCliente as $pc)
					<tr>
						<td>{{$pc->t_p_proveedor_id_remision}}</td>
						<td>{{$pc->id_dpproveedor}}</td>
						<td>{{$pc->producto_id_producto}}</td>
						<td>{{$pc->proveedor_id_proveedor}}</td>
						<td>{{$pc->cantidad}}</td>
						<td>{{$pc->precio_venta}}</td>
						<td>{{$pc->total}}</td>
						<td>
							<a href="" data-target="#modal-delete-{{$pc->id_dpproveedor}}" title="Eliminar" class="btn btn-danger btn-circle" data-toggle="modal"><i class="fas fa-trash"></i></a>
						</td>
						<td>	
							<a href="" title="Registro de cambios" class="btn btn-info btn-circle" data-target="#modal-infoPedidoCliente-{{$pc->id_dpproveedor}}" data-toggle="modal"><i class="fas fa-info-circle"></i></a>
						</td>
					</tr>
					@include('almacen.pedidosDevoluciones.productoPedidoUnoa.modal')
					@include('almacen.pedidosDevoluciones.productoPedidoUnoa.modalInfoPedidoCliente')
					@endforeach
				</table>
				
				@endif
			@endif
		@endforeach

        </div>
        {{$detalleCliente->render()}}
	</div>
	
	{!!Form::model($pedidoCliente,['method'=>'PATCH','route'=>['almacen.pedidosDevoluciones.productoPedidoUnoa.update',$id]])!!}
	{{Form::token()}}

	@foreach($pedidoCliente as $pc)
		@if($pc->id_remision==$id)
			@if($pc->finalizar=='1')
			<div class="form-row">
				<div class="form-group col-sm-12">
					<button class="btn btn-warning" type="submit" disabled>Pedido Finalizado</button>
				</div>
			</div>
			@else
			<div class="form-row">
				<div class="form-group col-sm-12">
					<button class="btn btn-warning" type="submit">Finalizar Pedido</button>
				</div>
			</div>
			@endif
		@endif
	@endforeach
	

	{!!Form::close()!!}

</div>
@endsection