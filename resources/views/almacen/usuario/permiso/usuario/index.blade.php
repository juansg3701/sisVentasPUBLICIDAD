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
											<a href="" data-target="#modal-registrar" data-toggle="modal"><button class="btn btn-info">Registrar permiso</button></a>

						<a href="" data-target="#modal-borrar" data-toggle="modal"><button class="btn btn-danger">Eliminar permiso</button></a>
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
															
															@if(count($ModulosGenerales)!=0)
															@foreach($cargos as $c)
																@if($ModulosGenerales[0]->id_cargo==$c->id_cargo)
																<option value="{{$c->id_cargo}}">{{$c->nombre}}</option>
																@endif
															@endforeach	
															@else
															<option value="0">No tiene permisos</option>
															@endif

															@foreach($cargos as $c)
															@if(count($ModulosGenerales)!=0)
																@if($ModulosGenerales[0]->id_cargo!=$c->id_cargo)
																<option value="{{$c->id_cargo}}">{{$c->nombre}}</option>
																@endif
															@else
															<option value="{{$c->id_cargo}}">{{$c->nombre}}</option>
															@endif

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
																$chek10="";?>

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
														@endforeach

											    		<div class="checkbox" >
											    		<label><input type="checkbox" id="cbox1" value="first_checkbox" disabled="true" <?php echo $chek1?>> Permisos</label><br>	
														<label><input type="checkbox" id="cbox1" value="first_checkbox" disabled="true" <?php echo $chek2?>> Empleados</label><br>

														<label><input type="checkbox" id="cbox9" value="first_checkbox" disabled="true" <?php echo $chek9?>> Clientes</label><br>

														<label><input type="checkbox" id="cbox10" value="first_checkbox" disabled="true" <?php echo $chek10?>> Inventario clientes</label><br>

														<label><input type="checkbox" id="cbox2" value="first_checkbox" disabled="true" <?php echo $chek3?>> Proveedores</label><br>
														<label><input type="checkbox" id="cbox1" value="first_checkbox" disabled="true" <?php echo $chek4?>> Devoluciones</label><br>
														<label><input type="checkbox" id="cbox1" value="first_checkbox" disabled="true" <?php echo $chek5?>> Sedes</label><br>
														<label><input type="checkbox" id="cbox1" value="first_checkbox" disabled="true" <?php echo $chek6?>> Inventario</label><br>
														<label><input type="checkbox" id="cbox1" value="first_checkbox" disabled="true" <?php echo $chek7?>> Pedidos</label><br>
														<label><input type="checkbox" id="cbox1" value="first_checkbox" disabled="true" <?php echo $chek8?>> Reportes</label><br>
														<br>
														

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


		@include('almacen.usuario.permiso.usuario.modalRegistrar')
	@include('almacen.usuario.permiso.usuario.modalBorrar')


			
		
</body>

@stop