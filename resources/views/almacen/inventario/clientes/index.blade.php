@extends ('layouts.admin')
@section ('contenido')
		
<head>
	<title>Inventario</title>
</head>

<body>

	<div class="row" align="center">
		<div class="col-sm-12" align="center">
			<!--<h1 class="pb-2 display-4">SEDES</h1>-->
			<br><h1 class="text-center title-1">STOCK CLIENTES</h1><br>
		</div>
	</div>

	<div class="row" align="center">	
		<div class="col-sm-3" align="center"></div>
			<div class="col-sm-6" align="center">
				<div class="card" align="center">
				   <div class="card-header" align="center">
				    	<strong></strong>
				    </div>
				    
				</div>
			</div>
		<div class="col-sm-3" align="center"></div>
	</div>

</body>
@stop

@section('tabla')

<div class="card shadow mb-10">
    <div class="card-header py-3" align="center">
	    <h6 class="m-0 font-weight-bold">Productos registrados</h6>
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
					<th>VENCE</th>
					<th>ESTADO</th>
				</thead>
				@foreach($productos as $ps)
				@if($validacion==1 && count($cuenta)!=0)
				@if($cuenta[0]->empresa_id_empresa==$ps->nombre_empresa && $cuenta[0]->empresa_categoria_id==$ps->nombre_subempresa)
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
					<td>{{ $ps->fecha_vencimiento}}</td>

					@if($ps->producto_dados_baja=='1')
						<td>Dado de baja</td>
					@endif
					@if($ps->producto_dados_baja=='0')
						<td>Disponible</td>
					@endif
					
				@endif
				@endif

				@if($validacion==0 && count($cuenta)!=0)
				@if($cuenta[0]->empresa_id_empresa==$ps->nombre_empresa)
				<tr>
					<td>{{ $ps->nombre}}</td>
					<td>
						<label>
							<a href="" title="Ver imagen" class="btn btn-light" data-target="#modal-infoImagen-{{$ps->id_stock_clientes}}" data-toggle="modal">
							<img src="{{asset('imagenes/articulos/'.$ps->img)}}" alt="{{ $ps->nombre}}" height="100px" width="100px" class="img-thumbnail"></a>
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
					<td>{{ $ps->fecha_vencimiento}}</td>

					@if($ps->producto_dados_baja=='1')
						<td>Dado de baja</td>
					@endif
					@if($ps->producto_dados_baja=='0')
						<td>Disponible</td>
					@endif
					
				@endif
				@endif


				
				@include('almacen.inventario.stockclientes.modalInfoStock')
				@include('almacen.inventario.stockclientes.modalImagen')
				@endforeach
			</table>
		</div>
		{{$productos->render()}}
    </div>
</div>

@stop