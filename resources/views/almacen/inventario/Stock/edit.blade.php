@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Editar producto stock</title>
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

	{!!Form::model($stock,['method'=>'PATCH','route'=>['almacen.inventario.stock.update',$stock->id_stock]])!!}
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
					<div class="" align="center"></div>
					 	<div class="col-sm-12" align="center">
							<div class="card" align="center">
				                <div class="card-header" align="center">
				                     <strong>Formulario de edición</strong>
				                </div>
				                <div class="card-body card-block" align="center">

				                	<div class="form-row">
			                	<div class="form group col-sm-12" align="center">
			                	<div class="form-row">
									<div class="form-group col-sm-2">
											<div>Producto:</div>
										</div>
									<div class="form-group col-sm-3">
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
								
									<div class="form-group col-sm-1"></div>

									<div class="form-group col-sm-2">
											<div>Sede de ingreso:</div>
										</div>
									<div class="form-group col-sm-3">
											@if(auth()->user()->superusuario==0)
											<input type="hidden" name="sede_id_sede" value="{{$stock->sede_id_sede}}">
											<select name="sede_id_sede" class="form-control" value="{{$stock->sede_id_sede}}" disabled="">
												@foreach($sede as $s)
												@if($stock->sede_id_sede==$s->id_sede && $s->tipo_sede_id_tipo_sede==2)
												<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
												@endif
												@endforeach

												@foreach($sede as $s)
												@if($stock->sede_id_sede!=$s->id_sede && $s->tipo_sede_id_tipo_sede==2)
												<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
												@endif
												@endforeach
											</select>
											@else
											<select name="sede_id_sede" class="form-control" value="{{$stock->sede_id_sede}}">
												@foreach($sede as $s)
												@if($stock->sede_id_sede==$s->id_sede && $s->tipo_sede_id_tipo_sede==2)
												<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
												@endif
												@endforeach

												@foreach($sede as $s)
												@if($stock->sede_id_sede!=$s->id_sede && $s->tipo_sede_id_tipo_sede==2)
												<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
												@endif
												@endforeach
											</select>
											@endif
										</div>
								</div>

			                	</div>
			                </div>


									<div class="form-row">
			                	<div class="form group col-sm-12" align="center">
			                	<div class="form-row">
									<div class="form-group col-sm-2">
											<div>Proveedor:</div>
									</div>
									<div class="form-group col-sm-3">
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
								
									<div class="form-group col-sm-1"></div>

									<div class="form-group col-sm-2">
											<div>Tipo:</div>
										</div>
									<div class="form-group col-sm-3">
											<select name="tipo_stock_id" class="form-control" value="{{$stock->tipo_stock_id}}">
												@foreach($tipos as $t)
												@if($stock->tipo_stock_id==$t->id_stock_unoa)
												<option value="{{$t->id_stock_unoa}}">{{$t->nombre}}</option>
												@endif
												@endforeach

												@foreach($tipos as $t)
												@if($stock->tipo_stock_id!=$t->id_stock_unoa)
												<option value="{{$t->id_stock_unoa}}">{{$t->nombre}}</option>
												@endif
												@endforeach
											</select>
										</div>
								</div>

			                	</div>
			                </div>

			                <div class="form-row">
			                	<div class="form group col-sm-12" align="center">
			                	<div class="form-row">
									<div class="form-group col-sm-2">
											<div>Categoría:</div>
										</div>
									<div class="form-group col-sm-3">
											<select name="categoria_id_categoria" class="form-control">
												@foreach($categoria as $ct)
												@if($stock->categoria_id_categoria==$ct->id_categoriaStock)
												<option value="{{$ct->id_categoriaStock}}">{{$ct->nombre}}</option>
												@endif
												@endforeach

												@foreach($categoria as $ct)
												@if($stock->categoria_id_categoria!=$ct->id_categoriaStock)
												<option value="{{$ct->id_categoriaStock}}">{{$ct->nombre}}</option>
												@endif
												
												@endforeach
											</select>	
										</div>
								
									<div class="form-group col-sm-1"></div>

									<div class="form-group col-sm-2">
											<div>Cantidad:</div>
										</div>
									<div class="form-group col-sm-3">
											<input type="text" class="form-control" name="cantidad" value="{{$stock->cantidad}}" min="1" pattern="^[0-9]+">
									</div>
								</div>

			                	</div>
			                </div>

			                <div class="form-row">
			                	<div class="form group col-sm-12" align="center">
			                	<div class="form-row">
									<div class="form-group col-sm-2">
											<div>Fecha vencimiento:</div>
									</div>
									<div class="form-group col-sm-3">
											<input type="date" class="form-control" name="fecha_vencimiento" value="{{$stock->fecha_vencimiento}}">
										</div>
								
									<div class="form-group col-sm-1"></div>

									<div class="form-group col-sm-2">
											<div>Estado:</div>
										</div>
									<div class="form-group col-sm-3">
											<select name="producto_dados_baja" class="form-control" value="{{$stock->producto_dados_baja}}" >
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

			                	</div>
			                </div>

			                <div class="form-row">
			                	<div class="form group col-sm-12" align="center">
			                	<div class="form-row">
									<div class="form-group col-sm-2">
											<div>Fecha:</div>
										</div>
									<div class="form-group col-sm-3">
											<input type="datetime" name="" value="<?php echo date("Y/m/d"); ?>" class="form-control" disabled="true">
											<input type="hidden" name="fecha_registro" value="<?php echo date("Y/m/d"); ?>" class="form-control">
										</div>
								
									<div class="form-group col-sm-1"></div>

									<div class="form-group col-sm-2">
											<div>Empleado:</div>
										</div>
									<div class="form-group col-sm-3">
											<select name="" class="form-control" disabled="true">
												@foreach($usuarios as $usu)
												@if(Auth::user()->id==$usu->user_id_user)
												<option value="{{$usu->id_empleado}}">{{$usu->nombre}}</option>
												<input type="hidden" name="empleado_id_empleado" value="{{$usu->id_empleado}}">
												@endif
												@endforeach
											</select>
										</div>
								</div>

			                	</div>
			                </div>

					

									<div class="form-row">
										<div class="form-group col-sm-12">
											<button type="submit" class="btn btn-info">Registrar</button>
											<a href="{{url('almacen/inventario/stock')}}" class="btn btn-danger">Regresar</a>									
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