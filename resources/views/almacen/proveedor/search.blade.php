
<!--Este es el archivo para la búsqueda de registros-->
{!! Form::open(array('url'=>'almacen/proveedor','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<!--Formulario para establecer los filtros de búsqueda-->
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
								<div>Empresa:</div>
							</div>
							<div class="form-group col-sm-8">
								<input id="pro1" type="text" class="form-control" name="searchText0" placeholder="Buscar..." value="{{$searchText0}}">
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-sm-4">
								<div>Contacto:</div>
							</div>
							<div class="form-group col-sm-8">
								<input id="pro1" type="text" class="form-control" name="searchText3" placeholder="Buscar..." value="{{$searchText3}}">
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-sm-4">
								<div>NIT:</div>
							</div>
							<div class="form-group col-sm-6">
								<input id="pro2"  type="text" class="form-control" name="searchText1" placeholder="Buscar..." value="{{$searchText1}}">
							</div>
							<div class="form-group col-sm-2">
								<input id="pro2"  type="text" class="form-control" name="searchText2" placeholder="Buscar..." value="{{$searchText2}}">
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-sm-12">
								<span class="input-group-btn">
									<button type="submit" class="btn btn-primary">Buscar</button>
								</span>
							</div>
						</div>
											
				    </div>
				</div>
			</div>
		<div class="col-sm-3" align="center"></div>
	</div>
</div>
{{Form::close()}}