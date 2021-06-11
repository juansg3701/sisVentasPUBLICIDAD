@extends ('layouts.admin')
@section ('contenido')
  <head>
  <title>Reportes</title>
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
      //   document.getElementById("menuToggle").click();
  

      var data2 = google.visualization.arrayToDataTable([
          ['Productos', 'mes'],
            @foreach ($pedidos_mensuales as $v)
                  ['{{$v->producto}}',{{$v->noproductos}}],
            @endforeach
      ]);

        
        var options2 = {  
          title: 'Gráfica detallado de inventario por cantidad'
        };


        var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));

        chart2.draw(data2, options2);
      }
    </script>
   </head>

<body>
<!--Formulario de búsqueda y opciones-->
  <div class="content">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header" align="center">
              <h2 class="pb-2 display-5">REPORTE DETALLADO DE INVENTARIO</h2>
            </div><br>
            <div class="row" align="center">  
                <div class="col-sm-12" align="center">
                 
                    <div class="row" align="center">
                           
                            <div  class="col-sm-12" align="center">
                            <div id="piechart2" style="width: 600px; height: 300px;"></div>
                            </div>
                    </div>
                    <div class="row" align="center">
                            <div class="col-sm-12">

                              <div align="center">
                                 <br>
                                 <b> Pedidos entre el:</b><br>
                                  {{$fecha_inicial}} y<br>
                                  {{$fecha_final}}
                              </div>

                             <br>
                            <div align="center">
                              <a href="{{url('almacen/reportes/inventario')}}" class="btn btn-danger">Volver</a>
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

          <div class="card-body">




            <table id="bootstrap-data-table" class="table table-striped table-bordered">
              <thead>
              <th>PRODUCTO</th>
              <th>CANTIDAD</th>
            
            </thead>
            @foreach($pedidos_mensuales as $ps)
            <tr>
              <td>{{ $ps->producto}}</td>
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

@stop