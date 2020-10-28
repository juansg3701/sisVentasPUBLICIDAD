@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Inventario - Stock - Bajas</title>
    <!--importar jquery para el manejo de algunos campos del formulario-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>


<body>
	<div class="row">
		<div class="col-sm" align="center">
			<h2>PRODUCTOS DADOS DE BAJA</h2>
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

	<!--Formulario de opciones-->
	<div class="row" align="center">	
		<div class="col-sm-12" align="center">
			<div class="card" align="center"><br>
				<div class="row" align="center">	
					<div class="col-sm-3" align="center"></div>
						<div class="col-sm-6" align="center">
							<div class="card" align="center">
								<div class="card-header" align="center">
									<strong></strong>
								</div>
								<div class="card-body card-block" align="center">
									<a href="{{url('almacen/inventario/proveedor-sede')}}" class="btn btn-danger">Regresar</a>
									<br><br>			
								</div>
							</div>
						</div>
					<div class="col-sm-3" align="center"></div>
				</div><br>
			</div>
		</div>
	</div>

</body>

@stop


@section('tabla')
<div class="container-fluid"><br>
	<div class="col-sm-12" align="center">
		<div class="col-sm-6" align="center">
			<h1 class="h3 mb-2 text-gray-800">PRODUCTOS REGISTRADOS</h1>
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
		@include('almacen.inventario.proveedor-sede.searchBaja')
	</div>	
</div>



<!--Tabla de registros realizados-->
<div class="card shadow mb-10">
    <div class="card-header py-3" align="center">
	    <h6 class="m-0 font-weight-bold">Lista de productos</h6>
    </div>
    <div class="card-body">
    	<div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<th>NOMBRE</th>
					<th>PLU</th>
					<th>EAN</th>
					<th>SEDE</th>
					<th>PROVEEDOR</th>
					<th>CATEGORÍA</th>
					<th>CANTIDAD</th>
					<th>VENCE</th>
					<th>ESTADO</th>
					<th colspan="3">OPCIONES</th>
				</thead>
				@foreach($productos as $ps)
				@if($ps->sede_id_sede==auth()->user()->sede_id_sede && auth()->user()->superusuario==0)
				<tr>
					<td>{{ $ps->nombre}}</td>
					<td>{{ $ps->plu}}</td>
					<td>{{ $ps->ean}}</td>
					<td>{{ $ps->nombre_sede}}</td>
					<td>{{ $ps->nombre_proveedor}}</td>
					<td>{{ $ps->categoria_id_categoria}}</td>
					<td>{{ $ps->cantidad}}</td>
					<td>{{ $ps->fecha_vencimiento}}</td>

					@if($ps->producto_dados_baja=='1')
						<td>Dado de baja</td>
					@endif
					@if($ps->producto_dados_baja=='0')
						<td>Disponible</td>
					@endif
					<td>
						<a href="{{URL::action('ProveedorSedeController@edit',$ps->id_stock)}}" title="Editar" class="btn btn-success btn-circle"><i class="fas fa-check"></i></a>
					</td>
					<td>
						<a href="" data-target="#modal-delete-{{$ps->id_stock}}" title="Eliminar" class="btn btn-danger btn-circle" data-toggle="modal"><i class="fas fa-trash"></i></a>	
					</td>
					<td>					
						<a href="" title="Registro de cambios" class="btn btn-info btn-circle" data-target="#modal-infoStock-{{$ps->id_stock}}" data-toggle="modal"><i class="fas fa-info-circle"></i></a>
					</td>
				</tr>
				@include('almacen.inventario.proveedor-sede.modal')
				@include('almacen.inventario.proveedor-sede.modalInfoStock')
				@endif
				@if(auth()->user()->superusuario==1)
				<tr>
					<td>{{ $ps->nombre}}</td>
					<td>{{ $ps->plu}}</td>
					<td>{{ $ps->ean}}</td>
					<td>{{ $ps->nombre_sede}}</td>
					<td>{{ $ps->nombre_proveedor}}</td>
					<td>{{ $ps->categoria_id_categoria}}</td>
					<td>{{ $ps->cantidad}}</td>
					<td>{{ $ps->fecha_vencimiento}}</td>
				
					
					@if($ps->producto_dados_baja=='1')
						<td>Dado de baja</td>
					@endif
					@if($ps->producto_dados_baja=='0')
						<td>Disponible</td>
					@endif
					<td>
						<a href="{{URL::action('ProveedorSedeController@edit',$ps->id_stock)}}" title="Editar" class="btn btn-success btn-circle"><i class="fas fa-check"></i></a>
					</td>
					<td>
						<a href="" data-target="#modal-delete-{{$ps->id_stock}}" title="Eliminar" class="btn btn-danger btn-circle" data-toggle="modal"><i class="fas fa-trash"></i></a>	
					</td>
					<td>					
						<a href="" title="Registro de cambios" class="btn btn-info btn-circle" data-target="#modal-infoStock-{{$ps->id_stock}}" data-toggle="modal"><i class="fas fa-info-circle"></i></a>
					</td>
				</tr>
				@endif
				@include('almacen.inventario.proveedor-sede.modal')
				@include('almacen.inventario.proveedor-sede.modalInfoStock')
				@endforeach
            </table>
		</div>
		{{$productos->render()}}
    </div>
</div>

@stop