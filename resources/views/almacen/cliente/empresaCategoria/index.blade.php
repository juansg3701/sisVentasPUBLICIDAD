@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Cliente-Subempresa</title>
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
	
	<br>


	{!!Form::open(array('url'=>'almacen/cliente/empresaCategoria','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    <div class="col-md-12">
		<div class="card">
			<div class="card-header" align="center">
				<h3 class="pb-2 display-5">REGISTRAR SUBEMPRESA</h3>
			</div><br>
			<div class="row" align="center">	
				<div class="col-sm-3" align="center"></div>
				 	<div class="col-sm-6" align="center">
						<div class="card" align="center">
			                <div class="card-header" align="center">
			                     <strong>Formulario de registro</strong>
			                </div><br>
			                <div class="card-body card-block" align="center">
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Nombre:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="nombre">
									</div>
								</div>
								
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Descripción:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="descripcion">
									</div>
								</div>
								
								<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Empresa:</div>
										</div>
										<div class="form-group col-sm-8">
											<select name="empresa_id_empresa" class="form-control">
												@foreach($empresas as $e)
													<option value="{{$e->id_empresa}}">{{$e->nombre}}</option>
												@endforeach
											</select>
										</div>
								</div>

								<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Fecha:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="datetime" name="fecha" value="<?php echo date("Y/m/d"); ?>" class="form-control" readonly>
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
											</select><br>
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
									<div class="form-group col-sm-12">
										
										
										<button type="submit" href="" class="btn btn-info">Registrar subempresa</button>
										<a href="{{url('almacen/cliente/empresa')}}" class="btn btn-danger">Volver</a>
									
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
			
	
</body>
@stop

@section('tabla')

<!--Tabla de registros realizados-->



<div class="container-fluid"><br>
	<div class="col-sm-12" align="center">
		<div class="col-sm-6" align="center">
			<h1 class="h3 mb-2 text-gray-800">SUBEMPRESAS REGISTRADAS</h1>
		</div>
	</div><br>
</div>




<div class="card shadow mb-10">
    <div class="card-header py-3" align="center">
	    <h6 class="m-0 font-weight-bold">Lista de productos</h6>
    </div>
    <div class="card-body">
    	<div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<th>NOMBRE SUBEMPRESA</th>
					<th>DESCRIPCIÓN</th>
					<th>EMPRESA</th>
					<th colspan="2">OPCIONES</th>
				</thead>
				@foreach($empresaCategoria as $em)
				<tr>
					<td>{{ $em->nombre}}</td>
					<td>{{ $em->descripcion}}</td>
					<td>{{ $em->nombreEmpresa}}</td>
					<td>
						
						<a href="{{URL::action('EmpresaCategoriaController@edit',$em->id_empresa_categoria)}}" title="Editar" class="btn btn-success btn-circle"><i class="fas fa-check"></i></a>
					</td>
					<td>
						<a href="" data-target="#modal-delete-{{$em->id_empresa_categoria}}" title="Eliminar" class="btn btn-danger btn-circle" data-toggle="modal"><i class="fas fa-trash"></i></a>
					</td>	
				</tr>
				@include('almacen.cliente.empresaCategoria.modal')
				@endforeach
			</table>
		</div>
		{{$empresaCategoria->render()}}
    </div>
</div>

@stop