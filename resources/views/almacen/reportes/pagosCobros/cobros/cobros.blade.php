@extends ('layouts.admin')
@section ('contenido')
<head>
	<title>Reportes</title>
</head>

<body>
	<div class="row" align="center">
			<div align="center"><h3>REPORTES FACTURAS POR COBRAR</h3></div><br>
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


	<div id=formulario>
	{!!Form::open(array('url'=>'almacen/reportes/pagosCobros/cobros','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
		<div id=formulario>
			<div class="form-group">
			Fecha inicio: <input type="date" class="form-control" name="fechaInicial">
			Fecha final: <input type="date" class="form-control" name="fechaFinal">
			<input type="hidden" class="form-control" name="fechaActual" value="<?php echo date("Y/m/d"); ?>"><br>
			<div align="center">
			<button type="submit" class="btn btn-info">Generar Reporte</button>
			<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
		</div>
			</div>
		</div>
	{!!Form::close()!!}	
	</div>
</body>
@stop
@section('tabla')
<div align="center"><h3>REPORTES GENERADOS</h3></div><br>

<div align="center">
<div align="center"><h4>Comparar Gráficas</h4></div>
{!! Form::open(array('url'=>'almacen/reportes/pagosCobros/compararGPC2','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}

	Reporte 1:
  	<select name="id1">
        @foreach($reportes as $r)
        <option value="{{$r->id_rpc}}">No: {{$r->id_rpc}}, Fecha: {{$r->fechaActual}}</option>
        @endforeach
    </select>&nbsp&nbsp&nbsp&nbsp&nbsp
    Reporte 2:
    <select name="id2">
        @foreach($reportes as $r)
        <option value="{{$r->id_rpc}}">No: {{$r->id_rpc}}, Fecha: {{$r->fechaActual}}</option>
        @endforeach
    </select><br><br>
    <span class=""><button type="submit" class="">Comparar</button></span><br><br>
      
{!!Form::close()!!} 
</div>


<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>ID</th>
							<th>FECHA DE CONSULTA</th>
							<th>FECHA INICIAL</th>
							<th>FECHA FINAL</th>	
							<th>OPCIONES</th>
						</thead>
						@foreach($reportes as $rep)
						<tr>
							<td>{{ $rep->id_rpc}}</td>
							<td>{{ $rep->fechaActual}}</td>
							<td>{{ $rep->fechaInicial}}</td>
							<td>{{ $rep->fechaFinal}}</td>
			
							<td>
								<a href="{{URL::action('reportesPC2@edit',$rep->id_rpc)}}"><button class="btn btn-info">Gráfica</button></a>
								<a href="{{URL::action('reportesPC2Descargas@edit',$rep->id_rpc)}}"><button class="btn btn-warning"><i>pdf</i></button></a>
								<a href="{{URL::action('reportesPC2Descargas@show',$rep->id_rpc)}}"><button class="btn btn-success"><i>xls</i></button></a>
								<a href="" data-target="#modal-delete-{{$rep->id_rpc}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('almacen.reportes.pagosCobros.cobros.modal')	
						@endforeach
					</table>
				</div>
				
			</div>
			</div><br>


	
			
@stop