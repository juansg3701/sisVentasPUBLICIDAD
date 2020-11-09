@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Usuarios</title>
</head>

<body>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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


	{!!Form::model($usuario,['method'=>'PATCH','route'=>['almacen.nomina.empleado.update',$usuario->id_cliente]])!!}
    {{Form::token()}}

     <!--Formulario de edición-->	
	<div class="col-md-12">
		<div class="card">
			<div class="card-header" align="center">
				<h3 class="pb-2 display-5">EDITAR CUENTA</h3>
			</div><br>

			<div class="col-sm-12" align="center">
				Editar datos de: {{$usuario->nombre}}
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
										<div>Nombre:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="nombre" value="{{$usuario->nombre}}">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Cargo:</div>
									</div>
									<div class="form-group col-sm-8">
										<select name="tipo_cargo_id_cargo" class="form-control">

											@foreach($cargos as $car)
												@if($car->id_cargo==$usuario->tipo_cargo_id_cargo)
												<option value="{{$car->id_cargo}}">{{$car->nombre}}</option>
												
												@endif
											@endforeach

											@foreach($cargos as $car)
												@if($car->id_cargo!=$usuario->tipo_cargo_id_cargo)
												<option value="{{$car->id_cargo}}" >{{$car->nombre}}</option>
												
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
										<select name="sede_id_sede" class="form-control">
											@foreach($sedes as $sed)
											@if($sed->tipo_sede_id_tipo_sede==1)
											@if($sed->id_sede==$usuario->sede_id_sede)
											<option value="{{$sed->id_sede}}">{{$sed->nombre_sede}}</option>
											
											@endif
											@endif

											
											@endforeach

											@foreach($sedes as $sed)
											@if($sed->tipo_sede_id_tipo_sede==1)
											@if($sed->id_sede!=$usuario->sede_id_sede)
											<option value="{{$sed->id_sede}}">{{$sed->nombre_sede}}</option>
											@endif
											@endif
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Empresa:</div>
									</div>
									<div class="form-group col-sm-8">
										<select name="empresa_id_empresa" class="form-control">
											@foreach($empresas as $e)
											@if($e->id_empresa==$usuario->empresa_id_empresa)
											<option value="{{$e->id_empresa}}">{{$e->nombre}}</option>
											
											@endif
											@endforeach

											@foreach($empresas as $e)
											@if($e->id_empresa!=$usuario->empresa_id_empresa)
											<option value="{{$e->id_empresa}}">{{$e->nombre}}</option>
											
											@endif
											@endforeach
										</select>
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Subempresas:</div>
									</div>
									<div class="form-group col-sm-8">
										<select name="empresa_categoria_id" class="form-control">
											@if($usuario->empresa_categoria_id!=0)
												@foreach($subempresas as $em)
													@if($usuario->empresa_categoria_id==$em->id_empresa_categoria)
													<option value="{{$em->id_empresa_categoria}}">{{$em->nombreSubempresa}} ({{$em->nombreEmpresa}})</option>
													@endif
												
												@endforeach

												@foreach($subempresas as $em)
													@if($usuario->empresa_categoria_id!=$em->id_empresa_categoria)
													<option value="{{$em->id_empresa_categoria}}">{{$em->nombreSubempresa}} ({{$em->nombreEmpresa}})</option>
													@endif
												
												@endforeach
												<option value="0">Ninguna</option>
											@else
												<option value="0">Ninguna</option>
												@foreach($subempresas as $em)
													<option value="{{$em->id_empresa_categoria}}">{{$em->nombreSubempresa}} ({{$em->nombreEmpresa}})</option>
												@endforeach
											@endif
											
										</select>
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Dirección:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="direccion" value="{{$usuario->direccion}}">
									</div>
								</div>
								<input type="hidden" name="tipo_cuenta" value="1">
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Telefono:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="number" class="form-control" name="telefono" value="{{$usuario->telefono}}">
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>NIT:</div>
									</div>
									<div class="form-group col-sm-6">
										<input type="number" class="form-control" name="documento" placeholder="- - - - - - -" min="0" value="{{$usuario->documento}}">
									</div>
									<div class="form-group col-sm-2">		
										<input type="number"  class="form-control" name="verificacion_nit" placeholder="-" min="0" max="9" value="{{$usuario->verificacion_nit}}">
									</div>
								</div>
								
		
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Correo:</div>
									</div>
									<div class="form-group col-sm-8">
										@foreach($users as $u)
											@if($u->id==$usuario->user_id_user)
												<input type="hidden" class="form-control" value="{{$u->email}}"name="correo">
								
											<input class="form-control" value="{{$u->email}}" disabled="true" name="correo">
											
											@endif
										
											@endforeach
								
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-12">
										<button class="btn btn-info" type="submit">Guardar</button>
										<a href="{{url('almacen/cliente/cliente')}}" class="btn btn-danger">Volver</a>
									</div>
								</div>
			               </div>
			        	</div>
					</div>
				<div class="col-sm-3" align="center"></div>
			</div>
		</div>
	</div>

{!!Form::close()!!}		

		

@stop