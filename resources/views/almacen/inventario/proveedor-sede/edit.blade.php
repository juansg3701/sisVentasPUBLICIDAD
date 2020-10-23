@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Editar producto stock</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->


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

	{!!Form::model($stock,['method'=>'PATCH','route'=>['almacen.inventario.proveedor-sede.update',$stock->id_stock]])!!}
	{{Form::token()}}
	
	<div class="row" align="center">	
		<div class="col-sm-12" align="center">
			<div class="card" align="center">
				<div class="row" align="center">
					<div class="col-sm-12" align="center">
						<br><h1 class="h3 mb-2 text-gray-800">EDITAR PRODUCTOS DE STOCK</h1>
					</div>
					<div class="col-sm-12" align="center">
						Editar datos de stock<br>
					</div>
				</div><br>
				<div class="row" align="center">	
					<div class="col-sm-3" align="center"></div>
					 	<div class="col-sm-6" align="center">
							<div class="card" align="center">
				                <div class="card-header" align="center">
				                     <strong>Formulario de edición</strong>
				                </div>
				                <div class="card-body card-block" align="center">

									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Producto:</div>
										</div>
										<div class="form-group col-sm-8">
											<select name="producto_id_producto" class="form-control" value="{{$stock->producto_id_producto}}">
												@foreach($producto as $p)
												@if($stock->producto_id_producto==$p->id_producto)
												<option value="{{$p->id_producto}}">{{$p->nombre}}</option>
												@endif
												@endforeach

												@foreach($producto as $p)
												@if($stock->producto_id_producto!=$p->id_producto)
												<option value="{{$p->id_producto}}">{{$p->nombre}}</option>
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
											@if(auth()->user()->superusuario==0)
											<input type="hidden" name="sede_id_sede" value="{{$stock->sede_id_sede}}">
											<select name="sede_id_sede" class="form-control" value="{{$stock->sede_id_sede}}" disabled="">
												@foreach($sede as $s)
												@if($stock->sede_id_sede==$s->id_sede)
												<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
												@endif
												@endforeach
												@foreach($sede as $s)
												@if($stock->sede_id_sede!=$s->id_sede)
												<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
												@endif
												@endforeach
											</select>
											@else
											<select name="sede_id_sede" class="form-control" value="{{$stock->sede_id_sede}}">
												@foreach($sede as $s)
												@if($stock->sede_id_sede==$s->id_sede)
												<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
												@endif
												@endforeach
												@foreach($sede as $s)
												@if($stock->sede_id_sede!=$s->id_sede)
												<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
												@endif
												@endforeach
											</select>
											@endif
										</div>
									</div>


									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Proveedor:</div>
										</div>
										<div class="form-group col-sm-8">
											<select name="proveedor_id_proveedor" class="form-control" value="{{$stock->proveedor_id_proveedor}}">
												@foreach($proveedor as $pr)
												@if($stock->proveedor_id_proveedor==$pr->id_proveedor)
												<option value="{{$pr->id_proveedor}}">{{$pr->nombre_proveedor}}</option>
												@endif
												@endforeach

												@foreach($proveedor as $pr)
												@if($stock->proveedor_id_proveedor!=$pr->id_proveedor)
												<option value="{{$pr->id_proveedor}}">{{$pr->nombre_proveedor}}</option>
												@endif
												@endforeach
											</select>
										</div>
									</div>

									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Cantidad:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="text" class="form-control" name="cantidad" value="{{$stock->cantidad}}">
										</div>
									</div>

									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Fecha vencimiento:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="date" class="form-control" name="fecha_vencimiento" value="{{$stock->fecha_vencimiento}}">
										</div>
									</div>

									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Estado:</div>
										</div>
										<div class="form-group col-sm-8">
											<select name="producto_dados_baja" class="form-control" value="{{$stock->producto_dados_baja}}">
												@if($stock->producto_dados_baja=='1')
												<option value="0">Dado de baja</option>
												<option value="1">Disponible</option>
												@endif
												@if($stock->producto_dados_baja=='0')
												<option value="1">Disponible</option>
												<option value="0">Dado de baja</option>
												@endif
											</select>
										</div>
									</div>


									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Fecha:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="datetime" name="fecha_registro" value="<?php echo date("Y/m/d"); ?>" class="form-control">
										</div>
									</div>

									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Empleado:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="hidden" name="empleado_id_empleado" value="{{Auth::user()->id}}">

											<select name="" class="form-control" disabled="true">
												@foreach($usuarios as $usu)
												@if(Auth::user()->id==$usu->user_id_user)
												<option value="{{$usu->id_empleado}}">{{$usu->nombre}}</option>
												@endif
												@endforeach

												@foreach($usuarios as $usu)
												@if(Auth::user()->id!=$usu->user_id_user)
												<option value="{{$usu->id_empleado}}">{{$usu->nombre}}</option>
												@endif
												@endforeach	
											</select>
										</div>
									</div>

									<div class="form-row">
										<div class="form-group col-sm-12">
											<button type="submit" class="btn btn-info">Registrar</button>
											<a href="{{url('almacen/inventario/proveedor-sede')}}" class="btn btn-danger">Regresar</a>									
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