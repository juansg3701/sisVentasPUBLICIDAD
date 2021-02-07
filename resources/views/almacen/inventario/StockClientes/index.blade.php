@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Inventario - Stock clientes</title>
    <!--importar jquery para el manejo de algunos campos del formulario-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>


<body>
	<div class="row">
		<div class="col-sm" align="center">
			<h2>PRODUCTOS STOCK CLIENTES</h2>
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
									<a href="{{url('almacen/inventario/eanClientes')}}"><button class="btn btn-warning">Registrar Productos</button></a>
									<a href="{{URL::action('CategoriaStockController@index',0)}}"><button class="btn btn-info">Días Especiales</button></a>

									<a href="{{URL::action('CategoriaProducto@index',0)}}"><button class="btn btn-info">Categoría producto</button></a>
									<a href="" data-target="#modal-cargar" data-toggle="modal"><button class="btn btn-warning">Cargar xlsx/xls</button></a>
									<a href="{{URL::action('StockClienteController@downloadExcel',0)}}"><button class="btn btn-success">Descargar xls</button></a>
							
									<a href="{{url('/')}}" class="btn btn-danger">Regresar</a>
									<br><br>			
								</div>
							</div>
						</div>
					<div class="col-sm-3" align="center"></div>
				</div><br>
			</div>
		</div>
	</div>
	<!--Formulario de búsqueda-->
<div class="form-group">
	<div class="form-group col-sm-7">
		<button id="btn_search" class="btn btn-outline-secondary btn-lg btn-block" style="display:hidden">Establecer filtros de búsqueda</button>
		<button id="btn_search2" class="btn btn-outline-secondary btn-lg btn-block" style="display:none">Ocultar filtros de búsqueda</button>
	</div>
	<div id="divBuscar" class="form-group" style="display:none">
		<!--Incluir la ventana modal de búsqueda-->	
		@include('almacen.inventario.stockclientes.search')
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
					<th>IMAGEN</th>
					<th>PLU</th>
					<th>EAN</th>
					<th>PRECIO</th>
					<th>SEDE CLIENTE</th>
					<th>EMPRESA</th>
					<th>SUBEMPRESA</th>
					<th>CATEGORÍA</th>
					<th>DÍA ESPECIAL</th>
					<th>CANTIDAD</th>
					<th>DESCRIPCI&Oacute;N</th>
					<th>VENCE</th>
					<th>ESTADO</th>
					<th colspan="3">OPCIONES</th>
				</thead>
				@foreach($productos as $ps)
				@if($ps->id_sede_empresa==auth()->user()->sede_id_sede && auth()->user()->superusuario==0)
				<tr>
					<td>{{ $ps->nombre}}</td>
					<td>
						<label>
							<a href="" title="Ver imagen" class="btn btn-light" data-target="#modal-infoImagen-{{$ps->id_stock_clientes}}" data-toggle="modal">
							<img src="{{asset('imagenes/articulosClientes/'.$ps->img)}}" alt="{{ $ps->nombre}}" height="100px" width="100px" class="img-thumbnail"></a>
						</label>
					</td>
					<td>{{ $ps->plu}}</td>
					<td>{{ $ps->ean}}</td>
					<td>{{ $ps->precio}}</td>
					<td>{{ $ps->sede_cliente}}</td>
					@if($ps->nombre_empresa!="")
						@foreach($empresas as $e)
							@if($e->id_empresa==$ps->nombre_empresa)	
							<td>{{ $e->nombre}}</td>
							@endif
						@endforeach
					@else
					<td></td>
					@endif

					@if($ps->nombre_subempresa!="")
						@foreach($subempresas as $e)
							@if($e->id_empresa_categoria==$ps->nombre_subempresa)	
							<td>{{ $e->nombre}}</td>
							@endif
						@endforeach
					@else
					<td></td>
					@endif
					<td>{{ $ps->categoria_normal}}</td>
					<td>{{ $ps->categoria_especial}}</td>
					<td>{{ $ps->cantidad}}</td>
					<td>{{ $ps->descripcion}}</td>
					<td>{{ $ps->fecha_vencimiento}}</td>

					@if($ps->producto_dados_baja=='1')
						<td>Dado de baja</td>
					@endif
					@if($ps->producto_dados_baja=='0')
						<td>Disponible</td>
					@endif
					<td>
						<a href="{{URL::action('StockClienteController@edit',$ps->id_stock_clientes)}}" title="Editar" class="btn btn-success btn-circle"><i class="fas fa-check"></i></a>
					</td>
					<td>
						<a href="" data-target="#modal-delete-{{$ps->id_stock_clientes}}" title="Eliminar" class="btn btn-danger btn-circle" data-toggle="modal"><i class="fas fa-trash"></i></a>	
					</td>
					<td>					
						<a href="" title="Registro de cambios" class="btn btn-info btn-circle" data-target="#modal-infoStock-{{$ps->id_stock_clientes}}" data-toggle="modal"><i class="fas fa-info-circle"></i></a>
					</td>
				</tr>
				@include('almacen.inventario.stockclientes.modal')
				@include('almacen.inventario.stockclientes.modalInfoStock')
				@include('almacen.inventario.stockclientes.modalImagen')
				@endif
				@if(auth()->user()->superusuario==1)
				<tr>
					<td>{{ $ps->nombre}}</td>
					<td>
						<label>
							<a href="" title="Ver imagen" class="btn btn-light" data-target="#modal-infoImagen-{{$ps->id_stock_clientes}}" data-toggle="modal">
							<img src="{{asset('imagenes/articulosClientes/'.$ps->img)}}" alt="{{ $ps->nombre}}" height="100px" width="100px" class="img-thumbnail"></a>
						</label>
					</td>
					<td>{{ $ps->plu}}</td>
					<td>{{ $ps->ean}}</td>
					<td>{{ $ps->precio}}</td>
					<td>{{ $ps->sede_cliente}}</td>
					@if($ps->nombre_empresa!="")
						@foreach($empresas as $e)
							@if($e->id_empresa==$ps->nombre_empresa)	
							<td>{{ $e->nombre}}</td>
							@endif
						@endforeach
					@else
					<td></td>
					@endif

					@if($ps->nombre_subempresa!="")
						@foreach($subempresas as $e)
							@if($e->id_empresa_categoria==$ps->nombre_subempresa)	
							<td>{{ $e->nombre}}</td>
							@endif
						@endforeach
					@else
					<td></td>
					@endif
					<td>{{ $ps->categoria_normal}}</td>
					<td>{{ $ps->categoria_especial}}</td>
					<td>{{ $ps->cantidad}}</td>
					<td>{{ $ps->descripcion}}</td>
					<td>{{ $ps->fecha_vencimiento}}</td>

					@if($ps->producto_dados_baja=='1')
						<td>Dado de baja</td>
					@endif
					@if($ps->producto_dados_baja=='0')
						<td>Disponible</td>
					@endif
					<td>
						<a href="{{URL::action('StockClienteController@edit',$ps->id_stock_clientes)}}" title="Editar" class="btn btn-success btn-circle"><i class="fas fa-check"></i></a>
					</td>
					<td>
						<a href="" data-target="#modal-delete-{{$ps->id_stock_clientes}}" title="Eliminar" class="btn btn-danger btn-circle" data-toggle="modal"><i class="fas fa-trash"></i></a>	
					</td>
					<td>					
						<a href="" title="Registro de cambios" class="btn btn-info btn-circle" data-target="#modal-infoStock-{{$ps->id_stock_clientes}}" data-toggle="modal"><i class="fas fa-info-circle"></i></a>
					</td>
				</tr>
				@endif
				@include('almacen.inventario.stockclientes.modal')
				@include('almacen.inventario.stockclientes.modalInfoStock')
				@include('almacen.inventario.stockclientes.modalImagen')
				@endforeach
            </table>
		</div>
		{{$productos->render()}}
    </div>
</div>

@stop