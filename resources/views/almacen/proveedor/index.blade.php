@extends ('layouts.admin')
@section ('contenido')
		
<head>
	<title>Proveedor</title>
	<!--importar jquery para el manejo de algunos campos del formulario-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
	<div class="row">
		<div class="col-sm" align="center">
			<h2>PROVEEDORES</h2>
		</div>
	</div>

	<!--Código de JQuery para mostrar/esconder los campos de búsqueda-->
	<script type="text/javascript">
		$(function() {
    		$("#btn_search").on("click", function() {
    			$("#divBuscar").prop("style", "display:hidden");
    			$("#btn_search").prop("style", "display:none");
    			$("#btn_search2").prop("style", "display:hidden");
    		});
    		$("#btn_search2").on("click", function() {
    			$("#divBuscar").prop("style", "display:none");
    			$("#btn_search2").prop("style", "display:none");
    			$("#btn_search").prop("style", "display:hidden");
    		});
		});
	</script>

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
								
								<div  align="center">
									<a href="{{URL::action('ProveedorController@create',0)}}"><button class="btn btn-info">Registrar Proveedor</button></a>	
									<a href="{{url('/')}}" class="btn btn-danger">Regresar</a>
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

<div class="container-fluid"><br>
	<div class="col-sm-12" align="center">
		<div class="col-sm-6" align="center">
			<h1 class="h3 mb-2 text-gray-800">PROVEEDORES REGISTRADOS</h1>
		</div>
	</div><br>
</div>

<!--Formulario de búsqueda-->
<div class="form-group">
	<div class="form-group col-sm-7">
		<button id="btn_search" class="btn btn-outline-secondary btn-lg btn-block" style="display:hidden">Establecer filtros de búsqueda</button>
		<button id="btn_search2" class="btn btn-outline-secondary btn-lg btn-block" style="display:none">Ocultar filtros de búsqueda</button>
	</div>
	<div id="divBuscar" class="form-group" style="display:none">
		<!--Incluir la ventana modal de búsqueda-->	
		@include('almacen.proveedor.search')
	</div>	
</div>

<div class="card shadow mb-10">
    <div class="card-header py-3" align="center">
	    <h6 class="m-0 font-weight-bold">Lista de proveedores</h6>
    </div>
    <div class="card-body">
    	<div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<th>EMPRESA</th>
					<th>CONTACTO</th>
					<th>DIRECCI&Oacute;N</th>
					<th>CORREO</th>
					<th>TEL&Eacute;FONO</th>
					
					<th colspan="2">NIT</th>
					<th colspan="3">OPCIONES</th>
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
					<td>					
						<a href="" title="Registro de cambios" class="btn btn-info btn-circle" data-target="#modal-infoProveedor-{{$pro->id_proveedor}}" data-toggle="modal"><i class="fas fa-info-circle"></i></a>
					</td>
				</tr>
				@include('almacen.proveedor.modal')
				@include('almacen.proveedor.modalInfoProveedor')
				@endforeach
			</table>
		</div>
		{{$proveedores->render()}}
    </div>
</div>

@stop