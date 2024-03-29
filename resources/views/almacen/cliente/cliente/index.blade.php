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
							<h2 class="pb-2 display-5">M&Oacute;DULO DE CUENTAS</h2>
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
								<th>Empresa</th>
								<th>Subempresas</th>
								<th colspan="2">NIT</th>
								<th>Dirección</th>
								<th>Telefono</th>
								<th colspan="2">OPCIONES</th>
							</thead>

							@foreach($usuarios as $usu)
							@if($usu->sede_id_sede==auth()->user()->sede_id_sede && auth()->user()->superusuario==0)
							<tr>

								<td>{{ $usu->nombre}}</td>
								<td>{{ $usu->correo}}</td>
								<td>{{ $usu->cargo}}</td>
								<td>{{ $usu->sede}}</td>
								<td>{{ $usu->empresa}}</td>
								@if($usu->empresa_categoria_id!=0)
								@foreach($subempresas as $s)
									@if($s->id_empresa_categoria==$usu->empresa_categoria_id)
									<td>{{ $s->nombre}}</td>
									@endif
								@endforeach
								@else
								<td></td>
								@endif
								<td>{{ $usu->documento}}</td>
								<td>{{ $usu->verificacion_nit}}</td>
								<td>{{ $usu->direccion}}</td>
								<td>{{ $usu->telefono}}</td>

								<td>
									<a href="{{URL::action('ClienteController@edit',$usu->user_id_user)}}" title="Editar" class="btn btn-success btn-circle"><i class="fas fa-check"></i></a>
									
								</td>	
								<td>
									<a href="" data-target="#modal-delete-{{$usu->id_cliente}}" title="Eliminar" class="btn btn-danger btn-circle" data-toggle="modal"><i class="fas fa-trash"></i></a>
								</td>
							</tr>
							@endif

							@if(auth()->user()->superusuario==1)
							<tr>
								<td>{{ $usu->nombre}}</td>
								<td>{{ $usu->correo}}</td>
								<td>{{ $usu->cargo}}</td>
								<td>{{ $usu->sede}}</td>
								<td>{{ $usu->empresa}}</td>
								@if($usu->empresa_categoria_id!=0)
								@foreach($subempresas as $s)
									@if($s->id_empresa_categoria==$usu->empresa_categoria_id)
									<td>{{ $s->nombre}}</td>
									@endif
								@endforeach
								@else
								<td></td>
								@endif
								<td>{{ $usu->documento}}</td>
								<td>{{ $usu->verificacion_nit}}</td>
								<td>{{ $usu->direccion}}</td>
								<td>{{ $usu->telefono}}</td>
								<td>
									<a href="{{URL::action('ClienteController@edit',$usu->user_id_user)}}" title="Editar" class="btn btn-success btn-circle"><i class="fas fa-check"></i></a>
								</td>
								<td>
									<a href="" data-target="#modal-delete-{{$usu->id_cliente}}" title="Eliminar" class="btn btn-danger btn-circle" data-toggle="modal"><i class="fas fa-trash"></i></a>
								</td>	
							</tr>
							@endif
							
						@include('almacen.cliente.cliente.modal')
							@endforeach
						</table>
						</div>
						{{$usuarios->render()}}
				    </div>
				</div>
@stop