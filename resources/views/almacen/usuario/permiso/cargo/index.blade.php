@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Usuario-Cargo</title>
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
	
	<br>


	{!!Form::open(array('url'=>'almacen/usuario/permiso/cargo','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    <div class="col-md-12">
		<div class="card">
			<div class="card-header" align="center">
				<h3 class="pb-2 display-5">REGISTRAR CARGO</h3>
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
										<div>Empleado:</div>
									</div>
									<div class="form-group col-sm-8">
										

										<select name="empleado_id_empleado" class="form-control" disabled="">
											@foreach($usuarios as $usu)
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
										<div>Fecha:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="datetime" name="fecha" value="<?php echo date("Y/m/d"); ?>" class="form-control" readonly>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-12">
										
										<a href="{{URL::action('PermisoCargoController@create',0)}}">
										<button href="" class="btn btn-info">Registrar Cargo</button></a>
										<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
									
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
			<h1 class="h3 mb-2 text-gray-800">CARGOS REGISTRADOS</h1>
		</div>
	</div><br>
</div>




<div class="card shadow mb-10">
    <div class="card-header py-3" align="center">
	    <h6 class="m-0 font-weight-bold">Lista de productos</h6>
    </div>
    <div class="card-body">
    	<div class="table-responsive">
    		<h4 class="pb-2 display-5">Nombre del cargo:</h3>
						@include('almacen.usuario.permiso.cargo.search')
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<th>NOMBRE</th>
					<th>DESCRIPCIÓN</th>
					<th>FECHA</th>
					<th>EMPLEADO</th>
					<th colspan="2">OPCIONES</th>
				</thead>
				@foreach($cargos as $car)
				<tr>
					<td>{{ $car->nombre}}</td>
					<td>{{ $car->descripcion}}</td>
					<td>{{ $car->fecha}}</td>
					<td>{{ $car->empleado}}</td>
					<td>
						
						<a href="{{URL::action('PermisoCargoController@edit',$car->id_cargo)}}" title="Editar" class="btn btn-success btn-circle"><i class="fas fa-check"></i></a>
					</td>
					<td>
						@if($car->id_cargo==1 || $car->id_cargo==3 || $car->id_cargo==4)
						<a href=""title="Eliminar" class="btn btn-danger btn-circle disabled" data-toggle="modal"><i class="fas fa-trash"></i>
						@else
							<a href="" data-target="#modal-delete-{{$car->id_cargo}}" title="Eliminar" class="btn btn-danger btn-circle" data-toggle="modal"><i class="fas fa-trash"></i></a>
						@endif
					
					</td>	
				</tr>
				@include('almacen.usuario.permiso.cargo.modal')
				@endforeach
			</table>
		</div>
		{{$cargos->render()}}
    </div>
</div>

@stop