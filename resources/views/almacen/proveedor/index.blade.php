@extends ('layouts.admin')
@section ('contenido')
		
<head>
	<title>Proveedor</title>
</head>

<body>
	<div class="row" align="center">
		<div class="col-sm-12" align="center">
			<!--<h1 class="pb-2 display-4">SEDES</h1>-->
			<br><h1 class="text-center title-1">MÓDULO DE PROVEEDORES</h1><br>
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
								@include('almacen.proveedor.search')<br>
			<div  align="center">
			<a href="{{URL::action('ProveedorController@create',0)}}"><button class="btn btn-info">Registrar Proveedor</button></a>	
			
			<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
			
			</div>
							</div>
						</div>
				    </div>
				</div>
			</div>
		<div class="col-sm-3" align="center"></div>
	</div>


	<div id=formulario>
		<div class="form-group">
			
		</div>
	</div>
</body>
@stop

@section('tabla')

<div class="card shadow mb-10">
    <div class="card-header py-3" align="center">
	    <h6 class="m-0 font-weight-bold">Proveedores registrados</h6>
    </div>
    <div class="card-body">
    	<div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<th>Nombre Empresa</th>
					<th>Contacto</th>
					<th>Dirección</th>
					<th>Correo</th>
					<th>Teléfono</th>
					<th>No. Documento</th>
					<th>No. NIT</th>
					<th colspan="2">OPCIONES</th>
				</thead>
				@foreach($proveedores as $pro)
				<tr>
					<td>{{ $pro->nombre_empresa}}</td>
					<td>{{ $pro->nombre_proveedor}}</td>
					<td>{{ $pro->direccion}}</td>
					<td>{{ $pro->correo}}</td>
					<td>{{ $pro->telefono}}</td>
					<td>{{ $pro->documento}}</td>
					<td>{{ $pro->verificacion_nit}}</td>
					<td>	
							<a href="{{URL::action('ProveedorController@edit',$pro->id_proveedor)}}" title="Editar" class="btn btn-success btn-circle"><i class="fas fa-check"></i></a>

							
					</td>
					<td>
							
							<a href="" data-target="#modal-delete-{{$pro->id_proveedor}}" title="Eliminar" class="btn btn-danger btn-circle" data-toggle="modal"><i class="fas fa-trash"></i></a>
			
						
                	</td>
				
				</tr>
				@include('almacen.proveedor.modal')
				@endforeach
			</table>
		</div>
		{{$proveedores->render()}}
    </div>
</div>

@stop