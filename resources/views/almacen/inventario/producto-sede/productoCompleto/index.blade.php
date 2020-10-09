@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Proveedor</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
</head>

<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Lista de Productos Completos de Sede</h3>
		</div>
	</div>

	<div id=formulario>
		<div class="form-group">
		
			@include('almacen.inventario.producto-sede.productoCompleto.search')
		<br>


			<br>
			<div align="center">
			<a href="{{URL::action('ProductoSedeController@create',0)}}"><button class="btn btn-info">Registrar producto</button></a>
			<a href="{{URL::action('ImpuestoProducto@index',0)}}"><button class="btn btn-info">Registrar impuesto</button></a>
			<a href="{{URL::action('CategoriaProducto@index',0)}}"><button class="btn btn-info">Registrar categoria</button></a>
			<button class="btn btn-success">Cargar xls</button>
			<button class="btn btn-success">Descargar xls</button>
			<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
			<br><br>
			</div>
		</div>
	</div>
</body>

@stop
@section('tabla')
<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>ID</th>
							<th>NOMBRE</th>
							<th>PLU</th>
							<th>EAN</th>
							<th>CATEGORÍA</th>
							<th>UNIDAD MEDIDA</th>
							<th>PRECIO</th>
							<th>IMPUESTO</th>
							<th>STOCK MÍNIMO</th>
							<th>OPCIONES</th>
						</thead>
						@foreach($productos as $ps)
						<tr>
							<td>{{ $ps->id_producto}}</td>
							<td>{{ $ps->nombre}}</td>
							<td>{{ $ps->plu}}</td>
							<td>{{ $ps->ean}}</td>
							<td>{{ $ps->categoria_id_categoria}}</td>
							<td>{{ $ps->unidad_de_medida}}</td>
							<td>{{ $ps->precio}}</td>
							<td>{{ $ps->impuestos_id_impuestos}}</td>
							<td>{{ $ps->stock_minimo}}</td>
							<td>
								<a href="{{URL::action('ProductoSedeController@edit',$ps->id_producto)}}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$ps->id_producto}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('almacen.inventario.producto-sede.productoCompleto.modal')
						@endforeach
					</table>
				</div>
				{{$productos->render()}}
			</div>
</div><br>


        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Tables</h1>
          <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
							<th>ID</th>
							<th>NOMBRE</th>
							<th>PLU</th>
							<th>EAN</th>
							<th>CATEGORÍA</th>
							<th>UNIDAD MEDIDA</th>
							<th>PRECIO</th>
							<th>IMPUESTO</th>
							<th>STOCK MÍNIMO</th>
							<th>OPCIONES</th>
						</thead>
						@foreach($productos as $ps)
						<tr>
							<td>{{ $ps->id_producto}}</td>
							<td>{{ $ps->nombre}}</td>
							<td>{{ $ps->plu}}</td>
							<td>{{ $ps->ean}}</td>
							<td>{{ $ps->categoria_id_categoria}}</td>
							<td>{{ $ps->unidad_de_medida}}</td>
							<td>{{ $ps->precio}}</td>
							<td>{{ $ps->impuestos_id_impuestos}}</td>
							<td>{{ $ps->stock_minimo}}</td>
							<td>
								<a href="{{URL::action('ProductoSedeController@edit',$ps->id_producto)}}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$ps->id_producto}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('almacen.inventario.producto-sede.productoCompleto.modal')
						@endforeach
                </table>
			  </div>
			  {{$productos->render()}}
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->




@stop