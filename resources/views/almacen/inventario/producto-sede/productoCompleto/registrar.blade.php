@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Inventario</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
</head>

<body>

	{!!Form::open(array('url'=>'almacen/inventario/producto-sede/productoCompleto','method'=>'POST','autocomplete'=>'off'))!!}
	{{Form::token()}}
		
	<div class="row" align="center">	
		<div class="col-sm-12" align="center">
			<div class="card" align="center">
				<div class="row" align="center">
					<div class="col-sm-12" align="center">
						<br><h3>Registro de Productos de Sede</h3><br>
					</div>
				</div>
				<div class="row" align="center">	
					<div class="col-sm-3" align="center"></div>
					 	<div class="col-sm-6" align="center">
							<div class="card" align="center">
				                <div class="card-header" align="center">
				                     <strong>Formulario de registro</strong>
				                </div>
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
											<div>PLU:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="text" class="form-control" name="plu">
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>EAN</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="text" class="form-control" name="ean">
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Categoría</div>
										</div>
										<div class="form-group col-sm-8">
											<select name="categoria_id_categoria" class="form-control">
												@foreach($categorias as $ct)
												<option value="{{$ct->id_categoria}}">{{$ct->nombre}}</option>
												@endforeach
											</select>	
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Unidad de Medida</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="text" class="form-control" name="unidad_de_medida">
										</div>
									</div>

									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Precio</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="text" class="form-control" name="precio">
										</div>
									</div>

									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Impuesto</div>
										</div>
										<div class="form-group col-sm-8">
											<select name="impuestos_id_impuestos" class="form-control">
												@foreach($impuestos as $im)
												<option value="{{$im->id_impuestos}}">{{$im->nombre}}</option>
												@endforeach
											</select>	
										</div>
									</div>

									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Stock Mínimo</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="text" class="form-control" name="stock_minimo">
										</div>
									</div>

									<div class="form-row">
										<div class="form-group col-sm-12">
											<button class="btn btn-info" type="submit">Registrar</button>
											<a href="{{url('almacen/inventario/producto-sede/productoCompleto')}}" class="btn btn-danger">Regresar</a>
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