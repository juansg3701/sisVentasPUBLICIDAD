@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Inventario</title>
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

	<div class="row">
		<div class="col-sm" align="center">
			<h2>REGISTRAR PRODUCTO STOCK</h2>
		</div>
	</div>

	<div class="row" align="center">	
		<div class="col-sm-12" align="center">
			<div class="card" align="center">
				<div class="row" align="center">	
					<div class="col-sm-3" align="center"></div>
					 	<div class="col-sm-6" align="center"><br>
							<div class="card" align="center">
				                <div class="card-header" align="center">
				                     <strong>Formulario de registro</strong>
				                </div>
				                <div class="card-body card-block" align="center">

									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>EAN:</div>
										</div>
										<div class="form-group col-sm-8">
											{!! Form::open(array('url'=>'almacen/inventario/ean','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
												<div class="input-group">
													<input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
													<span class="input-group-btn">
														<button type="submit" class="btn btn-primary">Buscar</button>
													</span>
												</div>
											{{Form::close()}}
										</div>
									</div>


									{!!Form::open(array('url'=>'almacen/inventario/ean','method'=>'POST','autocomplete'=>'off'))!!}
									{{Form::token()}}


									@foreach($pEAN as $pE)
										Producto automático:
										<input type="hidden" class="form-control" name="producto_id_producto" value="{{$pE->id_producto}}">
										<input type="text" class="form-control" name="producto" value="{{$pE->nombre}}">
									@endforeach


									<?php
									$valor=count($pEAN);
									?>
									@if($valor==0)
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Producto:</div>
										</div>
										<div class="form-group col-sm-8">
										<select name="producto_id_producto" class="form-control">
											@foreach($producto as $p)
											<option value="{{$p->id_producto}}">{{$p->nombre}}</option>
											@endforeach
										</select>
										</div>
									</div>
									@endif

									@if(auth()->user()->superusuario==0)
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Sede:</div>
										</div>

										<div class="form-group col-sm-8">
											<input type="hidden" name="sede_id_sede" value="{{Auth::user()->sede_id_sede}}">
											<select name="sede_id_sede" class="form-control" disabled="">
												@foreach($sede as $s)
												@if( Auth::user()->sede_id_sede ==$s->id_sede)
													<option value="{{$s->id_sede}}" >{{$s->nombre_sede}}</option>
												aa
												@endif
												@endforeach

												@foreach($sede as $s)
												@if( Auth::user()->sede_id_sede !=$s->id_sede)
													<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
												aa
												@endif
												@endforeach
											</select>
										</div>
									</div>
									@else
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Sede:</div>
										</div>
										<div class="form-group col-sm-8">
											<select name="sede_id_sede" class="form-control">
												@foreach($sede as $s)
												@if( Auth::user()->sede_id_sede ==$s->id_sede)
													<option value="{{$s->id_sede}}" >{{$s->nombre_sede}}</option>
												aa
												@endif
												@endforeach
												@foreach($sede as $s)
												@if( Auth::user()->sede_id_sede !=$s->id_sede)
													<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
												aa
												@endif
												@endforeach
											</select>	
										</div>
									</div>
									@endif


									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Proveedor:</div>
										</div>
										<div class="form-group col-sm-8">
											<select name="proveedor_id_proveedor" class="form-control">
												@foreach($proveedor as $pr)
													<option value="{{$pr->id_proveedor}}">{{$pr->nombre_proveedor}}</option>
												@endforeach
											</select>
										</div>
									</div>


									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Cantidad:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="text" class="form-control" name="cantidad">
										</div>
									</div>

									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Fecha vencimiento:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="date" class="form-control" name="fecha_vencimiento">
										</div>
									</div>

									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Estado:</div>
										</div>
										<div class="form-group col-sm-8">
											<select name="producto_dados_baja" class="form-control">
												<option value="1">Disponible</option>
												<option value="0">Dado de baja</option>
											</select>
										</div>
									</div>

									
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Fecha:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="datetime" name="fecha_registro" value="<?php echo date("Y/m/d"); ?>" class="form-control" disabled="true">
										</div>
									</div>

									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Empleado:</div>
										</div>
										<div class="form-group col-sm-8">
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
				</div><br>
        	</div>
		</div>
	</div>

{!!Form::close()!!}	
</body>

@stop