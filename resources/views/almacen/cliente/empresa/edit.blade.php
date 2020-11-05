@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Empresa</title>
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

	{!!Form::model($empresa,['method'=>'PATCH','route'=>['almacen.cliente.empresa.update',$empresa->id_empresa]])!!}
    {{Form::token()}}

    <div class="row" align="center">
					<div class="col-sm-12" align="center">
						<br><h1 class="text-center title-1">Editar empresa</h1><br>
						Editar datos de: {{$empresa->nombre}}
					</div>
				</div><br>
    <div class="row" align="center">	
		<div class="col-sm-12" align="center">
			<div class="card" align="center">
				
				<div class="row" align="center">	
					<div class="col-sm-3" align="center"></div>
					 	<div class="col-sm-6" align="center">
							<div class="card" align="center">
				                <div class="card-header" align="center">
				                     <strong>Formulario de edición</strong>
				                </div>
				        
				                <div class="card-body card-block" align="center">
									<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Nombre:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="nombre" value="{{$empresa->nombre}}">
									</div>
								</div>
								
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Descripción:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="descripcion" value="{{$empresa->descripcion}}">
									</div>
								</div>

	
								<div class="form-row">
									<div class="form-group col-sm-12">
										<button class="btn btn-info" type="submit">Registrar</button>
										<a href="{{url('almacen/cliente/empresa')}}" class="btn btn-danger">Volver</a>
									</div>
								</div>
				               </div>
				        	</div>
						</div>
					<div class="col-sm-3" align="center"></div>
				</div>
        	</div>
		</div>
	</div>	


{!!Form::close()!!}		
</body>

@stop