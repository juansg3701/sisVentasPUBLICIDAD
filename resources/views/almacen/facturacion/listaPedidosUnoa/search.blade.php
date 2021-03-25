<!--Este es el archivo para la búsqueda de registros-->
{!! Form::open(array('url'=>'almacen/facturacion/listaPedidosUnoa','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
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
								<div>Fecha de solicitud:</div>
							</div>
							<div class="form-group col-sm-6">
								<input type="date" class="form-control" name="searchText" value="{{$searchText}}" >
							</div>
							<div class="form-group col-sm-2"> 
								<button type="submit" class="btn btn-primary">Buscar</button>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-sm-4">
								<div>Fecha de entrega:</div>
							</div>
							<div class="form-group col-sm-6">
								<input type="date" class="form-control" name="searchText2" value="{{$searchText2}}" >
							</div>
							<div class="form-group col-sm-2"> 
								<button type="submit" class="btn btn-primary">Buscar</button>
							</div>
						</div>
						
						<div class="form-row">
							<div class="form-group col-sm-4">
								<div>Número de remisión:</div>
							</div>
							<div class="form-group col-sm-6">
								<input id="ped1" type="text" class="form-control" name="searchText3" placeholder="Buscar..." >
							</div>
							<div class="form-group col-sm-2"> 
								<button type="submit" class="btn btn-primary">Buscar</button>
							</div>
						</div>

						<!--<div class="form-row">
							<div class="form-group col-sm-4">
								<div>Cliente:</div>
							</div>
							<div class="form-group col-sm-6">
								<input id="cli1" type="text" class="form-control" name="searchText4" placeholder="Buscar..." >
							</div>
							<div class="form-group col-sm-2"> 
								<button type="submit" class="btn btn-primary">Buscar</button>
							</div>
						</div>-->
											
				    </div>
				</div>
			</div>
		<div class="col-sm-3" align="center"></div>
	</div>
</div>
{{Form::close()}}