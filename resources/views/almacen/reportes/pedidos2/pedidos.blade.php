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
				<h3 class="pb-2 display-5"> Reporte de pedidos por empresas</h3>
			</div><br>
			<div class="row" align="center">	
				<div class="col-sm-3" align="center"></div>
				 	<div class="col-sm-6" align="center">
						<div class="card" align="center">
			                <div class="card-header" align="center">
			                     <strong>Formulario de consulta</strong>
			                </div><br>
			                <div class="card-body card-block" align="center">

			                {!!Form::model(0,['method'=>'PATCH','route'=>['almacen.reportes.pedidos2.update',0]])!!}
    							{{Form::token()}}


								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Seleccione la fecha inicial:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="date" name="inicio" class="form-control">
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Seleccione la fecha final:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="date" name="fin" class="form-control">
									</div>
								</div>
				
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Filtro:</div>
									</div>
									<div class="form-group col-sm-8">
										<select class="form-control" name="tipo_reporte">
											 <option value="3">Despachados</option>
											 <option value="2">Pendientes</option>
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

			               </div>
			        	</div>
					</div>
				<div class="col-sm-3" align="center"></div>
			</div>

		</div>
	</div>	

	<div>
		
	</div>

</body>
@stop
