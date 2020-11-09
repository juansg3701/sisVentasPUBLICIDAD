{!! Form::open(array('url'=>'almacen/inventario/stockClientes','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}


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
								<div>Categoría general:</div>
							</div>
							<div class="form-group col-sm-8">
								<select name="searchText1" value="{{$searchText1}}" class="form-control">
									<option value="">Todas las categorías</option>	
									@foreach($categoria_especiales as $cat)
									<option>{{$cat->nombre}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-sm-4">
								<div>Categoría especial:</div>
							</div>
							<div class="form-group col-sm-8">
								<select name="searchText2" value="{{$searchText2}}" class="form-control">
									<option value="">Todas las categorías</option>	
									@foreach($categoria as $cat)
									<option>{{$cat->nombre}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-sm-4">
								<div>Empresa:</div>
							</div>
							<div class="form-group col-sm-8">
								<select name="searchText3" value="{{$searchText3}}" class="form-control">
									<option value="">Todas las categorías</option>	
									@foreach($empresas as $e)
									<option>{{$e->nombre}}</option>
									@endforeach
								</select>
							</div>
						</div>

						
						<div class="form-row">
							<div class="form-group col-sm-4">
								<div>Nombre:</div>
							</div>
							<div class="form-group col-sm-8">
								<input id="buscar2" type="text" class="form-control" name="searchText5" placeholder="Buscar..." value="{{$searchText5}}">
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-sm-4">
								<div>PLU:</div>
							</div>
							<div class="form-group col-sm-8">
								<input id="pluP"  type="text" class="form-control" name="searchText6" placeholder="Buscar..." value="{{$searchText6}}">
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-sm-4">
								<div>EAN:</div>
							</div>
							<div class="form-group col-sm-8">
								<input id="pluP"  type="text" class="form-control" name="searchText7" placeholder="Buscar..." value="{{$searchText7}}">
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-sm-4">
								<div>Sede cliente:</div>
							</div>
							<div class="form-group col-sm-8">
								<input id="sed1" type="text" class="form-control" name="searchText8" placeholder="Buscar..." value="{{$searchText8}}">
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