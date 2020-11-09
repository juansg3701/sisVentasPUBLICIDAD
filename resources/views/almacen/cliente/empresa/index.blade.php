@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Cliente-Empresa</title>
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


	{!!Form::open(array('url'=>'almacen/cliente/empresa','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    <div class="col-md-12">
		<div class="card">
			<div class="card-header" align="center">
				<h3 class="pb-2 display-5">REGISTRAR EMPRESA</h3>
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
									<div class="form-group col-sm-12">
										
										
										<button type="submit" href="" class="btn btn-info">Registrar empresa</button>
										<a href="{{url('almacen/cliente/empresaCategoria')}}" class="btn btn-warning">M&oacutedulo subempresa</a>
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
			<h1 class="h3 mb-2 text-gray-800">EMPRESAS REGISTRADAS</h1>
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
					<th>NOMBRE</th>
					<th>DESCRIPCIÓN</th>
					<th colspan="2">OPCIONES</th>
				</thead>
				@foreach($empresas as $em)
				<tr>
					<td>{{ $em->nombre}}</td>
					<td>{{ $em->descripcion}}</td>
					<td>
						
						<a href="{{URL::action('EmpresaController@edit',$em->id_empresa)}}" title="Editar" class="btn btn-success btn-circle"><i class="fas fa-check"></i></a>
					</td>
					<td>
						<a href="" data-target="#modal-delete-{{$em->id_empresa}}" title="Eliminar" class="btn btn-danger btn-circle" data-toggle="modal"><i class="fas fa-trash"></i></a>
					</td>	
				</tr>
				@include('almacen.cliente.empresa.modal')
				@endforeach
			</table>
		</div>
		{{$empresas->render()}}
    </div>
</div>

@stop