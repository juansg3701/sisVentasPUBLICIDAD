@extends ('layouts.admin')
@section ('contenido')
	<head>
	<title>Reportes</title>
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

	<div class="col-md-12">
		<div class="card">
			<div class="card-header" align="center">
				<h3 class="pb-2 display-5"> Reporte de inventario</h3>
			</div><br>
			<div class="row" align="center">	
				<div class="col-sm-3" align="center"></div>
				 	<div class="col-sm-6" align="center">
						<div class="card" align="center">
			                <div class="card-header" align="center">
			                     <strong>Formulario de consulta</strong>
			                </div><br>
			                <div class="card-body card-block" align="center">

			                @if($searchText=="")
			                {!! Form::open(array('url'=>'almacen/reportes/inventarioclientes','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}

			                	<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Seleccione el empresa:</div>
									</div>
									<div class="form-group col-sm-8">
										<select class="form-control" name="searchText">
											@foreach($empresas as $e)
											<option value="{{$e->id_empresa}}"> {{$e->nombre}}</option>
											@endforeach
										
										</select>
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-12">
										
										<div align="center">
											<button type="submit" class="btn btn-info">Consultar empresa</button>
											<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
										</div>
									
									</div>
								</div>

								{!!Form::close()!!}	
			                @else
			                {!!Form::model(0,['method'=>'PATCH','route'=>['almacen.reportes.inventarioclientes.update',0]])!!}
    							{{Form::token()}}

    							<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Seleccione el empresa:</div>
									</div>
									<div class="form-group col-sm-8">
										<select class="form-control" name="searchText" disabled="true">
											@foreach($empresas as $e)
											@if($searchText==$e->id_empresa)
											<option value="{{$e->id_empresa}}"> {{$e->nombre}}</option>
											@endif
											@endforeach
										
										</select>
									</div>
								</div>
								<input type="hidden" name="empresa" value="{{$searchText}}">

    							<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Seleccione el aliado:</div>
									</div>
									<div class="form-group col-sm-8">
										<select class="form-control" name="subempresa">
											@if(count($subempresas)>0)
												@foreach($subempresas as $s)
												<option value="{{$s->id_empresa_categoria}}"> {{$s->nombre}}</option>
												@endforeach
											@else
												<option value="">No tiene aliados</option>
											@endif
										
										
										</select>
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Seleccione la fecha inicial:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="date" name="mes" class="form-control">
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Seleccione la fecha final:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="date" name="mes_final" class="form-control">
									</div>
								</div>
				
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Tipo de reporte:</div>
									</div>
									<div class="form-group col-sm-8">
										<select class="form-control" name="tipo_reporte">
											 <option value="1">General por meses</option>
											 <option value="2">Detallado</option>
											
										</select>
									</div>
								</div>

								
								<div class="form-row">
									<div class="form-group col-sm-12">
										
										<div align="center">
											<button type="submit" class="btn btn-info">Generar Reporte</button>
											<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
										</div>
									
									</div>
								</div>
								{!!Form::close()!!}	

			                @endif
			                	 
								
			               </div>
			        	</div>
					</div>
				<div class="col-sm-3" align="center"></div>
			</div>

		</div>
	</div>	

	<div>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		
		
	</div>

</body>
@stop
