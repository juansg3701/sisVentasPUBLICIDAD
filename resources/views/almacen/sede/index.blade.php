@extends ('layouts.admin')
@section ('contenido')
<!--Este archivo maneja la vista principal del módulo de sedes-->		
<head>
	<title>Proveedores</title>
	<!--importar ajax para el manejo de algunos campos del formulario-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
	<div class="row">
		<div class="col-sm" align="center">
			<h2>SEDES</h2>
		</div>
	</div>

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
								
								<div align="center">
									<!--Enlaces y botones para llamar las funciones de registro, descarga de excel y la ventana modal para carga de excel-->
									<a href="{{URL::action('SedeController@create',0)}}"><button class="btn btn-info">Registrar Sede</button></a>	
									<a href="{{url('/')}}" class="btn btn-danger">Regresar</a>
								</div>
							</div>
						</div>
				    </div>
				</div>
			</div>
		<div class="col-sm-3" align="center"></div>
	</div>



</body>
@endsection
@section('tabla')

<div class="container-fluid"><br>
	<div class="col-sm-12" align="center">
		<div class="col-sm-6" align="center">
			<h1 class="h3 mb-2 text-gray-800">SEDES REGISTRADAS</h1>
		</div>
	</div><br>
</div>

<div class="form-group col-sm">
	<!--Incluir la ventana modal de búsqueda-->	
	@include('almacen.sede.search')
</div>

<!--Tabla de registros realizados en la tabla de proveedor en la base de datos-->	
<div class="card shadow mb-10">
    <div class="card-header py-3" align="center">
	    <h6 class="m-0 font-weight-bold">Lista de sedes</h6>
    </div>
    <div class="card-body">
    	<div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<th>NOMBRE</th>
					<th>CIUDAD</th>
					<th>DESCRIPCIÓN</th>
					<th>DIRECCIÓN</th>
					<th>TELÉFONO</th>
					<th>TIPO</th>
					<th colspan="3">OPCIONES</th>
				</thead>
				@foreach($sedes as $sed)
				<tr>
					<td>{{ $sed->nombre_sede}}</td>
					<td>{{ $sed->ciudad}}</td>
					<td>{{ $sed->descripcion}}</td>
					<td>{{ $sed->direccion}}</td>
					<td>{{ $sed->telefono}}</td>
					<td>{{ $sed->tipo_sede_id_tipo_sede}}</td>
					@foreach($tipos as $t)
					@if($t->id_tipo_sede==$sed->tipo_sede_id_tipo_sede)
						<td>{{ $t->nombre}}</td>
					@endif
					@endforeach
					<td>	
						<a href="{{URL::action('SedeController@edit',$sed->id_sede)}}" title="Editar" class="btn btn-success btn-circle"><i class="fas fa-check"></i></a>
					</td>
					<td>
					@if(isset($sed->id_sede))
						@include('almacen.sede.modal')
						<a href="" data-target="#modal-delete-{{$sed->id_sede}}" title="Eliminar" class="btn btn-danger btn-circle" data-toggle="modal"><i class="fas fa-trash"></i></a>
					@endif		
					</td>
					<td>					
						<a href="" title="Registro de cambios" class="btn btn-info btn-circle" data-target="#modal-infoSede-{{$sed->id_sede}}" data-toggle="modal"><i class="fas fa-info-circle"></i></a>
					</td>
				</tr>
				@include('almacen.sede.modalInfoSede')
				@endforeach
            </table>
        </div>
        {{$sedes->render()}}
    </div>
</div>

@endsection

@include('almacen.sede.mod')
