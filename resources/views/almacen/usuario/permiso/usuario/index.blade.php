@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Usuario</title>
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


	<!--Formulario de búsqueda y opciones-->
	<div class="content">
		<div class="animated fadeIn">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header" align="center">
							<h2 class="pb-2 display-5">VER CARGOS Y MÓDULOS</h2>
						</div><br>
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
													<!--Incluir la ventana modal de búsqueda-->	
													<div id=formulario align="left">


													{!! Form::open(array('url'=>'almacen/usuario/permiso/usuario','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
																Cargo:
															<div class="input-group">
																	
															<select name="searchText" value="{{$searchText}}" class="form-control">
															<option value="0">Cargos</option>	
															@foreach($cargos as $c)
															<option value="{{$c->id_cargo}}">{{$c->nombre}}</option>
															@endforeach
														</select>	
														<br>
															<span class="input-group-btn">
																<button type="submit" class="btn btn-primary">Buscar</button>
															</span>
																</div>
														{{Form::close()}}
														<br>
														<?php 	$chek1=""; 
																$chek2="";
																$chek3="";
																$chek4="";
																$chek5="";
																$chek6="";
																$chek7="";
																$chek8="";
																$chek9="";
																$chek10="";
																$chek11="";?>

														@foreach($ModulosGenerales as $mg)
														
														@if($mg->id_modulo==1)
														<?php $chek1="checked";	?>

														@endif

														@if($mg->id_modulo==2)
														<?php $chek2="checked";	?>
														@endif

														@if($mg->id_modulo==3)
														<?php $chek3="checked";	?>
														@endif

														@if($mg->id_modulo==4)
														<?php $chek4="checked";	?>
														@endif

														@if($mg->id_modulo==5)
														<?php $chek5="checked";	?>
														@endif

														@if($mg->id_modulo==6)
														<?php $chek6="checked";	?>
														@endif

														@if($mg->id_modulo==7)
														<?php $chek7="checked";	?>
														@endif

														@if($mg->id_modulo==8)
														<?php $chek8="checked";	?>
														@endif

														@if($mg->id_modulo==9)
														<?php $chek9="checked";	?>
														@endif

														@if($mg->id_modulo==10)
														<?php $chek10="checked";	?>
														@endif

														@if($mg->id_modulo==11)
														<?php $chek11="checked";	?>
														@endif
														@endforeach

											    		<div class="checkbox" >
											    		<label><input type="checkbox" id="cbox1" value="first_checkbox" disabled="true" <?php echo $chek1?>> Usuarios</label><br>	
														<label><input type="checkbox" id="cbox1" value="first_checkbox" disabled="true" <?php echo $chek2?>> Proveedores</label><br>
														<label><input type="checkbox" id="cbox2" value="first_checkbox" disabled="true" <?php echo $chek3?>> Clientes</label><br>
														<label><input type="checkbox" id="cbox1" value="first_checkbox" disabled="true" <?php echo $chek4?>> Caja</label><br>
														<label><input type="checkbox" id="cbox1" value="first_checkbox" disabled="true" <?php echo $chek5?>> Inventario</label><br>
														<label><input type="checkbox" id="cbox1" value="first_checkbox" disabled="true" <?php echo $chek6?>> Nomina</label><br>
														<label><input type="checkbox" id="cbox1" value="first_checkbox" disabled="true" <?php echo $chek7?>> Pedidos</label><br>
														<label><input type="checkbox" id="cbox1" value="first_checkbox" disabled="true" <?php echo $chek8?>> Facturación</label><br>
														<label><input type="checkbox" id="cbox1" value="first_checkbox" disabled="true" <?php echo $chek9?>> Pagos y Cobros Pendientes</label><br>
														<label><input type="checkbox" id="cbox1" value="first_checkbox" disabled="true" <?php echo $chek10?>>Reportes</label><br>
														<label><input type="checkbox" id="cbox1" value="first_checkbox" disabled="true" <?php echo $chek11?>> Sedes</label><br><br>
														

													</div>

												</div>
													
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
		</div>
	</div>


	<!--Formulario de búsqueda y opciones-->
	<div class="content">
		<div class="animated fadeIn">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header" align="center">
							<h2 class="pb-2 display-5">REGISTRAR PERMISO</h2>
						</div><br>
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
													<!--Incluir la ventana modal de búsqueda-->	
													{!!Form::open(array('url'=>'almacen/usuario/permiso/usuario','method'=>'POST','autocomplete'=>'off'))!!}
										    		{{Form::token()}}

										<div id=formulario align="center">
													
													<br>
													Cargo:
														<select name="id_cargo" class="form-control">
													@foreach($cargos as $car)
													<option name="id_cargo" value="{{$car->id_cargo}}">{{$car->nombre}}</option>
													@endforeach
												</select>
										<br>
												Módulo:
													<select name="id_modulo" class="form-control">
													@foreach($mod as $m)
													<option name="id_modulo" value="{{$m->id_modulo}}">{{$m->nombre}}</option>
													@endforeach
												</select>

										<br>
										<br>
													<div align="center">
													<button type="submit" class="btn btn-info">Asignar permiso</button>
													<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
													</div>
												</div>

										{!!Form::close()!!}	
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
		</div>
	</div>


	<!--Formulario de búsqueda y opciones-->
	<div class="content">
		<div class="animated fadeIn">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header" align="center">
							<h2 class="pb-2 display-5">ELIMINAR PERMISO</h2>
						</div><br>
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
													<!--Incluir la ventana modal de búsqueda
													{!!Form::open(array('url'=>'almacen/usuario/permiso/usuario','method'=>'POST','autocomplete'=>'off'))!!}
										    		{{Form::token()}}-->	

										    		{!!Form::model(0,['method'=>'PATCH','route'=>['almacen.usuario.permiso.usuario.update',0]])!!}
    												{{Form::token()}}

										<div id=formulario align="center">
													
													<br>
													Cargo:
														<select name="id_cargo" class="form-control">
													@foreach($cargos as $car)
													<option name="id_cargo" value="{{$car->id_cargo}}">{{$car->nombre}}</option>
													@endforeach
												</select>
										<br>
												Módulo:
													<select name="id_modulo" class="form-control">
													@foreach($mod as $m)
													<option name="id_modulo" value="{{$m->id_modulo}}">{{$m->nombre}}</option>
													@endforeach
												</select>

										<br>
										<br>
													<div align="center">
													<button type="submit" class="btn btn-info">Eliminar permiso</button>
													<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
													</div>
												</div>

										{!!Form::close()!!}	
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
		</div>
	</div>
	

			
		
</body>

@stop