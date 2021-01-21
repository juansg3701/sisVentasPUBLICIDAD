@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Inventario</title>
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

	<div class="row">
		<div class="col-sm" align="center">
			<h2>REGISTRAR PRODUCTO STOCK CLIENTES</h2>
		</div>
	</div>

	<div class="row" align="center">	
		<div class="col-sm-12" align="center">
			<div class="card" align="center">
				<div class="row" align="center">	
					<div class="" align="center"></div>
					 	<div class="col-sm-12" align="center"><br>
							<div class="card" align="center">
				                <div class="card-header" align="center">
				                     <strong>Formulario de registro</strong>
				                </div>
				                <div class="card-body card-block" align="center">

				                	<div class="form-row">
										<div class="form-group col-sm-3" align="right">
											<div>Empresa:</div>
										</div>
										<div class="form-group col-sm-6">
											{!! Form::open(array('url'=>'almacen/inventario/eanClientes','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
												<div class="input-group">

											<select name="searchText" class="form-control">
												@if($searchText!="")
													@foreach($empresas as $e)
														@if($searchText==$e->id_empresa)
														<option value="{{$e->id_empresa}}">{{$e->nombre}}</option>
														@endif
													@endforeach
												@else
												<option value="">Seleccione una empresa</option>
												@endif
													

												

												@foreach($empresas as $e)
													@if($searchText!=$e->id_empresa)
													<option value="{{$e->id_empresa}}">{{$e->nombre}}</option>
													@endif

												@endforeach
											</select>


													<span class="input-group-btn">
														<button type="submit" class="btn btn-primary">Buscar</button>
													</span>
												</div>
											{{Form::close()}}
										</div>
										<div class="form-group col-sm-3">
										</div>
									</div>

									{!!Form::open(array('url'=>'almacen/inventario/eanClientes','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
									{{Form::token()}}
									<input type="hidden" name="empresa_id_empresa" value="{{$searchText}}">

									
								<div class="form-row">
			                	<div class="form group col-sm-12" align="center">
			                	<div class="form-row">
			                		<div class="form-group col-sm-2">
											<div>Subempresa:</div>
										</div>
									<div class="form-group col-sm-3">
											<select name="empresa_categoria_id" class="form-control">
												@foreach($subempresas as $e)
													<option value="{{$e->id_empresa_categoria}}">{{$e->nombre}}</option>
												@endforeach
											</select>
									</div>

									
								
									<div class="form-group col-sm-1"></div>
									<div class="form-group col-sm-2">
											<div>Nombre:</div>
									</div>
									<div class="form-group col-sm-3">
											<input type="text" name="nombre" class="form-control">
										</div>
									
								</div>

			                	</div>
			                </div>

			                <div class="form-row">
			                	<div class="form group col-sm-12" align="center">
			                	<div class="form-row">
			                		<div class="form-group col-sm-2">
											<div>Sede cliente:</div>
								</div>
							<div class="form-group col-sm-3">
								<select name="sede_id_sede_cliente" class="form-control">
									@foreach($sede as $s)
									@if( $s->tipo_sede_id_tipo_sede==1)
									
										<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
									
									@endif
									@endforeach
								</select>	
							</div>

								<div class="form-group col-sm-1"></div>
									<div class="form-group col-sm-2">
											<div>Precio:</div>
										</div>
									<div class="form-group col-sm-3">
											<input type="number" name="precio" class="form-control" min="1" pattern="^[0-9]+">
										</div>
									
								</div>

			                	</div>
			                </div>

			                <div class="form-row">
			                	<div class="form group col-sm-12" align="center">
			                	<div class="form-row">
									@if(auth()->user()->superusuario==0)
									
										<div class="form-group col-sm-2">
											<div>Sede empresa:</div>
										</div>

										<div class="form-group col-sm-3">
											<input type="hidden" name="sede_id_sede" value="{{Auth::user()->sede_id_sede}}">
											<select name="sede_id_sede" class="form-control" disabled="">
												@foreach($sede as $s)
												@if( Auth::user()->sede_id_sede ==$s->id_sede && $s->tipo_sede_id_tipo_sede==2)
													<option value="{{$s->id_sede}}" >{{$s->nombre_sede}}</option>
												
												@endif
												@endforeach

												@foreach($sede as $s)
												@if( Auth::user()->sede_id_sede !=$s->id_sede && $s->tipo_sede_id_tipo_sede==2)
													<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
												
												@endif
												@endforeach
											</select>
										</div>
									@else
						
			                			<div class="form-group col-sm-2">
											<div>Sede empresa:</div>
										</div>

										<div class="form-group col-sm-3">
											
											<select name="sede_id_sede" class="form-control" >
												@foreach($sede as $s)
												@if( Auth::user()->sede_id_sede ==$s->id_sede && $s->tipo_sede_id_tipo_sede==2)
													<option value="{{$s->id_sede}}" >{{$s->nombre_sede}}</option>
												
												@endif
												@endforeach

												@foreach($sede as $s)
												@if( Auth::user()->sede_id_sede !=$s->id_sede && $s->tipo_sede_id_tipo_sede==2)
													<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
												
												@endif
												@endforeach
											</select>
										</div>
					                
									
									@endif
								
									<div class="form-group col-sm-1"></div>
									<div class="form-group col-sm-2">
											<div>Cantidad:</div>
										</div>
									<div class="form-group col-sm-3">
											<input type="number" name="cantidad" class="form-control" min="1" pattern="^[0-9]+">
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
											<input type="date" class="form-control" name="fecha_vencimiento">
										</div>
								
										<div class="form-group col-sm-1"></div>
									<div class="form-group col-sm-2">
											<div>Descripci&oacute;n:</div>
										</div>
									<div class="form-group col-sm-3">
											<input type="text" name="descripcion" class="form-control">
									</div>
									
								</div>

			                	</div>
			                </div>

			                <div class="form-row">
			                	<div class="form group col-sm-12" align="center">
			                	<div class="form-row">
									
									<div class="form-group col-sm-2">
											<div>Categor&iacutea general:</div>
										</div>
									<div class="form-group col-sm-3">
											<select name="categoria_id_categoria" class="form-control">
												@foreach($categoria as $ct)
												<option value="{{$ct->id_categoria}}">{{$ct->nombre}}</option>
												@endforeach
											</select>	
										</div>
								
										<div class="form-group col-sm-1"></div>
										<div class="form-group col-sm-2">
												<div>Imagen:</div>
											</div>
										<div class="form-group col-sm-3">
												<input type="file" name="imagen" class="form-control" placeholder="">
										</div>
									
								</div>

			                	</div>
			                </div>

				
								<div class="form-row">
			                	<div class="form group col-sm-12" align="center">
			                	<div class="form-row">
									<div class="form-group col-sm-2">
											<div>Estado:</div>
										</div>
									<div class="form-group col-sm-3">
											<select name="producto_dados_baja" class="form-control">
												<option value="1">Disponible</option>
												<option value="0">Dado de baja</option>
											</select>
										</div>
								
										<div class="form-group col-sm-1"></div>
										<div class="form-group col-sm-2">
												<div>Categor&iacutea especiales:</div>
											</div>
										<div class="form-group col-sm-3">
												<select name="categoria_dias_especiales_id" class="form-control">
													@foreach($categoria_especiales as $ct)
													<option value="{{$ct->id_categoriaStock}}">{{$ct->nombre}}</option>
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
											<div>Fecha:</div>
										</div>
									<div class="form-group col-sm-3">
											<input type="datetime" name="" value="<?php echo date("Y/m/d"); ?>" class="form-control" disabled="true">
											<input type="hidden" name="fecha_registro" value="<?php echo date("Y/m/d"); ?>" class="form-control">
										</div>
								
										<div class="form-group col-sm-1"></div>
										<div class="form-group col-sm-2">
											<div>PLU:</div>
										</div>
										<div class="form-group col-sm-3">
											<input type="text" name="plu" class="form-control">
										</div>
								</div>

			                	</div>
			                </div>

			                <div class="form-row">
			                	<div class="form group col-sm-12" align="center">
			                	<div class="form-row">
								
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

											<div class="form-group col-sm-1"></div>
											<div class="form-group col-sm-2">
												<div>EAN:</div>
											</div>
											<div class="form-group col-sm-3">
													<input type="text" name="ean" class="form-control">
											</div>
											
								</div>

			                	</div>
			                </div>


									<div class="form-row">
										<div class="form-group col-sm-12">
											<button type="submit" class="btn btn-info">Registrar</button>
											<a href="{{url('almacen/inventario/stockClientes')}}" class="btn btn-danger">Regresar</a>
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