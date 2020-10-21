{!! Form::open(array('url'=>'almacen/inventario/producto-sede/productoCompleto','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
	<div class="row" align="center">	
		<div class="col-sm-3" align="center"></div>
			<div class="col-sm-6" align="center">
				<div class="card" align="center">
				    <div class="card-header" align="center">
				        <strong></strong>
			        </div>
				    <div class="card-body card-block" align="center">
						
						<div class="form-row">
							<div class="form-group col-sm-4">
								<div>Categoría:</div>
							</div>
							<div class="form-group col-sm-8">
								<select name="searchText3" value="{{$searchText3}}" class="form-control">
									<option>Todas las categorías</option>	
									@foreach($categoria as $cat)
									<option>{{$cat->nombre}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-sm-4">
								<div>Nombre:</div>
							</div>
							<div class="form-group col-sm-8">
								<input id="buscar2" type="text" class="form-control" name="searchText0" placeholder="Buscar..." value="{{$searchText0}}">
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-sm-4">
								<div>PLU:</div>
							</div>
							<div class="form-group col-sm-8">
								<input id="pluP"  type="text" class="form-control" name="searchText1" placeholder="Buscar..." value="{{$searchText1}}">
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-sm-4">
								<div>EAN:</div>
							</div>
							<div class="form-group col-sm-8">
								<input id="tags" type="text" class="form-control" name="searchText2" placeholder="Buscar..." value="{{$searchText2}}">
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