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
              <h2 class="pb-2 display-5">REPORTE DE PEDIDOS MENSUALES</h2>
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
                            <b> Pedidos de:</b>
                            <br>
                            <b>Empresa:</b> {{$nombre_empresa}}<br>
                            <br>
                            <b>Subempresa:</b> {{$nombre_subempresa}}<br>
                            <br>

                              </div>
                             <br>
                            <div align="center">
                              <a href="{{url('almacen/reportes/pedido')}}" class="btn btn-danger">Volver</a>
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
                $valores=$mes_inicial.'.'.$mes_final.'.'.$empresa_r.'.'.$subempresa_r.'.'.'1';
          ?>
         
          <div align="center">
              <a href="{{URL::action('reportesPedidos@downloadExcelReport',$valores)}}"><button class="btn btn-outline-success btn-sm">Descargar Excel</button></a>
              <a href="{{URL::action('reportesPedidos@downloadPDFReport',$valores)}}"><button class="btn btn-outline-danger btn-sm">Descargar PDF</button></a>
          </div>

          <div class="card-body">
    
            <table id="bootstrap-data-table" class="table table-striped table-bordered">
              <thead>
              <th>FECHA</th>
              <th>No. PRODUCTOS</th>
              </thead>
            @foreach($pedidos as $ps)
            <tr>
              <td>{{ $ps->fecha}} - {{$ps->fecha_year}}</td>
              <td>{{ $ps->noproductos}}</td>
              <!--  
              <td> 
                <?php
                $valores2=$ps->fecha_mes.'.'.$ps->fecha_year.'.'.$ps->fecha.'.'.'m';
                ?>
                
                <a href="{{url('almacen/editproductos/'.$valores2)}}">
                <button class="btn btn-outline-primary btn-sm">Detalle</button>
                </a>
                </td>
                -->
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
              "{{$ps->fecha}} - {{$ps->fecha_year}}",
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