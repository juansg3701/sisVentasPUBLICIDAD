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

								{!! Form::open(array('url'=>'almacen/pedidosDevoluciones/productoPedidoCliente','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}	
								<div class="card-body card-block" align="center">
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>EAN:</div>
										</div>
										<div class="form-group col-sm-8">
											<input id="tags" class="form-control" name="searchText" placeholder="Buscar...">
											<input type="hidden" class="form-control" name="t_p_cliente_id_remision" value="{{$id}}">
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

								{!!Form::open(array('url'=>'almacen/pedidosDevoluciones/productoPedidoCliente','method'=>'POST','autocomplete'=>'off'))!!}
								{{Form::token()}}
								<div class="card-body card-block" align="center">
									<div class="form-row">
										<div class="form-group col-sm-12">
											<div>No. Remisión:  {{$id}}</div>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-12">
											<input type="hidden" class="form-control" name="t_p_cliente_id_remision" value="{{$id}}"><br>
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

												@if($EAN->cantidad<=$EAN->minimo && $contador2=='0')
												<?php 
												$contador2=1;
												?>
												<script >
													window.alert("Producto con pocas unidades");
												</script>
											@endif

											@if($EAN->cantidad>0 && $contador=='0')
											<?php 
											$contador=1;
											?>

											<div class="form-row">
												<div class="form-group col-sm-4">
													<div>Nombre Producto:</div>
												</div>
												<div class="form-group col-sm-8">
													<input type="text" class="form-control" name="nombre" value="({{$EAN->nombre}}, {{$EAN->nproveedor}})">
													<input type="hidden" class="form-control" name="producto_id_producto" value="{{$EAN->id_producto}}" enable>
												</div>
											</div>

											<div class="form-row">
												<div class="form-group col-sm-4">
													<div>Precio unitario:</div>
												</div>
												<div class="form-group col-sm-8">
												<input type="text" class="form-control" name="precio_venta" value="{{$EAN->precioU}}">
												</div>
											</div>

											@if($EAN->nombre!='')
											<?php
											$Enable="enable";
											?>	
											@endif
											@endif
											@endforeach
											@endif

											@if($searchText1!="")

											@foreach($productosEAN2 as $EAN)

											@if($EAN->cantidad<=$EAN->minimo && $contadorB2=='0')
											<?php 
											$contadorB2=1;
											?>
											<script >
												window.alert("Producto con pocas unidades");
											</script>
											@endif
											@if($EAN->cantidad>0 && $contadorB=='0')
											<?php 
											$contadorB=1;
											?>

											<div class="form-row">
												<div class="form-group col-sm-4">
													<div>Nombre Producto:</div>
												</div>
												<div class="form-group col-sm-8">
													<input type="text" class="form-control" name="nombre" value="({{$EAN->nombre}}, {{$EAN->nproveedor}})">
													<input type="hidden" class="form-control" name="producto_id_producto" value="{{$EAN->id_producto}}" enable>
												</div>
											</div>

											<div class="form-row">
												<div class="form-group col-sm-4">
													<div>Precio unitario:</div>
												</div>
												<div class="form-group col-sm-8">
													<input type="text" class="form-control" name="precio_venta" value="{{$EAN->precioU}}">
												</div>
											</div>
		
											@if($EAN->nombre!='')
											<?php
											$Enable="enable";
											?>	
											@endif
											@endif
											@endforeach
											@endif
											@if($searchText1!="" && $contadorB!='1' && $contador!='1')
											<script >
												window.alert("Producto no disponible");
											</script>
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
												<div>Fecha:</div>
											</div>
											<div class="form-group col-sm-8">
												<input type="datetime-local" class="form-control" name="fecha" value="<?php echo date("Y/m/d h:i"); ?>">
											</div>
									</div>	

									<div class="form-row">
										<div class="form-group col-sm-12">
											<button class="btn btn-info" type="submit">Registrar</button>
											<a href="{{url('almacen/facturacion/listaPedidosClientes')}}" class="btn btn-danger">Regresar</a>
										</div>
									</div>
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
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<th>Remisión</th>
					<th>Id</th>
					<th>Producto</th>
					<th>Cantidad</th>
					<th>Precio unitario</th>
					<th>Total</th>
					<th>Opciones</th>
				</thead>
				@foreach($detalleCliente as $pc)
				<tr>
					<td>{{$pc->t_p_cliente_id_remision}}</td>
					<td>{{$pc->id_dpcliente}}</td>
					<td>{{$pc->producto_id_producto}}</td>
					<td>{{$pc->cantidad}}</td>
					<td>{{$pc->precio_venta}}</td>
					<td>{{$pc->total}}</td>
					<td>
						<a href="" data-target="#modal-delete-{{$pc->id_dpcliente}}" title="Eliminar" class="btn btn-danger btn-circle" data-toggle="modal"><i class="fas fa-trash"></i></a>
					</td>
				</tr>
				@include('almacen.pedidosDevoluciones.productoPedidoCliente.modal')
				@endforeach
            </table>
        </div>
        {{$detalleCliente->render()}}
	</div>
	
	<div class="form-row">
		<div class="form-group col-sm-12">
				<button class="btn btn-warning" type="submit">Finalizar Pedido</button>
		</div>
	</div>
</div>
@endsection