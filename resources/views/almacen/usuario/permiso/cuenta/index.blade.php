@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Usuario-Cuentas</title>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
		<!--Código de JQuery para mostrar/esconder los campos del atributo documento-->
	<script type="text/javascript">
		$(function() {
    		$("#btn_search").on("click", function() {
    			$("#divBuscar").prop("style", "display:hidden");
    			$("#btn_search").prop("style", "display:none");
    			$("#btn_search2").prop("style", "display:hidden");
    		});
    		$("#btn_search2").on("click", function() {
    			$("#divBuscar").prop("style", "display:none");
    			$("#btn_search2").prop("style", "display:none");
    			$("#btn_search").prop("style", "display:hidden");
    		});
		});
	</script>
	<!--Formulario de búsqueda y opciones-->
	<div class="content">
		<div class="animated fadeIn">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header" align="center">
							<h2 class="pb-2 display-5">MÓDULO DE CUENTAS</h2>
						</div><br>
						<div class="row" align="center">	
							<div class="col-sm-3" align="center"></div>
								<div class="col-sm-6" align="center">
									<div class="card" align="center">
										<div class="card-header" align="center">
											<strong></strong>
										</div>
										<div class="card-body card-block" align="center">
											<div id=formulario>
												<div class="form-group">
														<button id="btn_search" class="btn btn-outline-secondary btn-lg btn-block" style="display:hidden">Establecer filtros de búsqueda</button>
														<button id="btn_search2" class="btn btn-outline-secondary btn-lg btn-block" style="display:none">Ocultar filtros de búsqueda</button>
													</div>
													<div id="divBuscar" class="form-group" style="display:none">
														<!--Incluir la ventana modal de búsqueda-->	
														@include('almacen.usuario.permiso.cuenta.search')
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
		</div>
	</div>

</body>
@stop

@section('tabla')
<!--Tabla de registros realizados-->
<div class="card shadow mb-10">
    <div class="card-header py-3" align="center">
	    <h6 class="m-0 font-weight-bold">Lista de cuentas</h6>
    </div>
    <div class="card-body">
    	<div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
								<th>Nombre</th>
								<th>Correo</th>
								<th>Cargo</th>
								<th>Sede</th>
								<th>Tipo</th>
								<th>OPCIONES</th>
							</thead>

							@foreach($usuarios as $usu)
							@if($usu->sede_id_sede==auth()->user()->sede_id_sede && auth()->user()->superusuario==0)
							<tr>
								<td>{{ $usu->name}}</td>
								<td>{{ $usu->email}}</td>
								@foreach($cargos as $mp)
								@if($mp->id_cargo==$usu->tipo_cargo_id_cargo)
								<td>{{ $mp->nombre}}</td>
								@endif
								@endforeach

								@foreach($sedes as $sp)
								@if($sp->id_sede==$usu->sede_id_sede)
								<td>{{ $sp->nombre_sede}}</td>
								@endif
								@endforeach
							
									@if($usu->tipo_cuenta==0)
									<td>Empleado</td>
									@else
									<td>Cliente</td>
									@endif
								
								<td>
									@if($usu->tipo_cuenta==0)
									<a href="{{URL::action('UsersController@edit',$usu->id)}}" title="Editar" class="btn btn-success btn-circle"><i class="fas fa-check"></i></a>
									
									@else
									<a href="{{URL::action('ClienteController@edit',$usu->id)}}" title="Editar" class="btn btn-success btn-circle"><i class="fas fa-check"></i></a>
									
									@endif
									
									
								</td>	
							</tr>
							@include('almacen.usuario.permiso.cuenta.modal')
							@endif

							@if(auth()->user()->superusuario==1)
							<tr>
								<td>{{ $usu->name}}</td>
								<td>{{ $usu->email}}</td>
								@foreach($cargos as $mp)
								@if($mp->id_cargo==$usu->tipo_cargo_id_cargo)
								<td>{{ $mp->nombre}}</td>
								@endif
								@endforeach

								@foreach($sedes as $sp)
								@if($sp->id_sede==$usu->sede_id_sede)
								<td>{{ $sp->nombre_sede}}</td>
								@endif
								@endforeach
								
								@if($usu->tipo_cuenta==0)
									<td>Empleado</td>
									@else
									<td>Cliente</td>
									@endif
								<td>
						

								@if($usu->tipo_cuenta==0)
									<a href="{{URL::action('UsersController@edit',$usu->id)}}" title="Editar" class="btn btn-success btn-circle"><i class="fas fa-check"></i></a>
									
									@else
									<a href="{{URL::action('ClienteController@edit',$usu->id)}}" title="Editar" class="btn btn-success btn-circle"><i class="fas fa-check"></i></a>
									
									@endif
									
								</td>	
							</tr>
							@endif
							@endforeach
						</table>
						</div>
						{{$usuarios->render()}}
				    </div>
				</div>

@stop