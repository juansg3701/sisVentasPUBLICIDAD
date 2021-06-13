
{!! Form::open(array('url'=>'almacen/reportes/inventarioclientes/2','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}

<div class="form-group">
	<div class="row" align="center">	
		<div class="col-sm-3" align="center"></div>
			<div class="col-sm-6" align="center">
				<div class="card" align="center">
				    <div class="card-header" align="center">
				        <strong>Filtros de búsqueda</strong>
			        </div>
				    <div class="card-body card-block" align="center">
						
						<div class="form-row">
							<div class="form-group col-sm-4">
								<div>Nombre producto:</div>
							</div>
							<div class="form-group col-sm-4">
								<input id="pro1" type="text" class="form-control" name="searchText0" placeholder="Buscar..." value="{{$searchText0}}">
							</div>
							<div class="form-group col-sm-4">
								<span class="input-group-btn">
									<button type="submit" class="btn btn-primary">Buscar</button>
								</span>
							</div>
						</div>

						<input type="hidden" name="fecha_inicial" value="{{$fecha_inicial}}">

						<input type="hidden" name="fecha_final" value="{{$fecha_final}}">

						<input type="hidden" name="tipo_reporte_detallado" value="{{$tipo_reporte_detallado}}">

						<input type="hidden" name="empresa_r" value="{{$empresa_r}}">

						<input type="hidden" name="subempresa_r" value="{{$subempresa_r}}">

						<input type="hidden" name="nombre_empresa" value="{{$nombre_empresa}}">

						<input type="hidden" name="nombre_subempresa" value="{{$nombre_subempresa}}">

											
				    </div>
				</div>
			</div>
		<div class="col-sm-3" align="center"></div>
	</div>
</div>
{{Form::close()}}