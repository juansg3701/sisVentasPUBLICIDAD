@extends ('layouts.admin')
@section ('contenido')
<!DOCTYPE html>
      <script data-require="chart.js@*" data-semver="1.0.2" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
    <link rel="stylesheet" href="style.css" />
<body>
<!--Formulario de búsqueda y opciones-->
  <div class="content">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header" align="center">
              <h2 class="pb-2 display-5">REPORTE DE PEDIDOS POR EMPRESA</h2>
            </div><br>
            <div class="row" align="center">  
                <div class="col-sm-12" align="center">
                 
                    <div class="row" align="center">
                            <div  class="col-sm-12" align="center">
                               <canvas id="buyers"style="width:400px; height:200px; overflow-x: auto; overflow-y: auto;  white-space: nowrap;"></canvas>
                            </div>
                          </div>
                           <div class="row" align="center">
                            <div class="col-sm-12" align="center">
                              <div align="center">
               
                             <br>
                            <b> Pedidos entre:</b><br>
                            <b>Inicio:</b> {{$inicio}} <br>
                            <b>Fin:</b> {{$fin}}<br>
                            <b>Tipo:</b> {{$nombre_tipo_reporte}}<br>
                            <br>
                  

                              </div>
                             <br>
                            <div align="center">
                              <a href="{{url('almacen/reportes/pedidos2')}}" class="btn btn-danger">Volver</a>
                            </div>
                               
                            </div>

                          </div>
                  
                </div>
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
<div class="content">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header" align="center">
            <h3 class="pb-2 display-5">DETALLE DE REPORTE</h3>
          </div>

          <?php
                $valores=$inicio.'.'.$fin.'.'.$tipo_reporte.'.'.'2';
          ?>
         
          <div align="center">
              <a href="{{URL::action('reportesPedidos2@downloadExcelReport',$valores)}}"><button class="btn btn-outline-success btn-sm">Descargar Excel</button></a>
              <a href="{{URL::action('reportesPedidos2@downloadPDFReport',$valores)}}"><button class="btn btn-outline-danger btn-sm">Descargar PDF</button></a>
          </div>

          <div class="card-body">
    
            <table id="bootstrap-data-table" class="table table-striped table-bordered">
              <thead>
              <th>EMPRESA</th>
              <th>No. de pedidos</th>
              <th>No. PRODUCTOS</th>
              </thead>
            @foreach($pedidos as $ps)
            <tr>
              <td>{{ $ps->empresa}} - {{ $ps->subempresa}}</td>
              <td>{{ $ps->numero_pedidos}}</td>
              <td>{{ $ps->noproductos}}</td>
            </tr>   
            @endforeach
          </table>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>

 <script>
  var buyerData = {
    labels : [@foreach($pedidos as $ps)
              "{{$ps->empresa}} - {{ $ps->subempresa}}",
              @endforeach],
    datasets : [
      {
        fillColor : "#AFCBFF",
        strokeColor : "#85E3FF",
        pointColor : "#6EB5FF",
        pointStrokeColor : "#6EB5FF",
        data : [@foreach($pedidos as $ps)
              "{{$ps->noproductos}}",
              @endforeach]
        
      }
    ]
  }

  var buyers = document.getElementById('buyers').getContext('2d');
  new Chart(buyers).Bar(buyerData, {
    animation: true,
    animationSteps: 100,
    animationEasing: "easeOutQuart",
    scaleFontSize: 16,
    responsive: true,
    showTooltip: true,
    tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
    
    scaleShowGridLines : false,
    bezierCurve : false,
    pointDotRadius : 5,

  });
</script>

@stop