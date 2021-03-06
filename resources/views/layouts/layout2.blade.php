<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Unoa</title>
    <link rel="apple-touch-icon" href="{{asset('img/Logo12.jpeg')}}">
    <link rel="shortcut icon" href="{{asset('img/Logo12.jpeg')}}">
  <!-- Custom fonts for this template-->
  <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i')}}" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('almacen/inventario/producto-sede/productoCompleto')}}">
          <div >
          <img src="{{asset('img/Logo1.jpeg')}}" width="100" height="40">
        </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider">

      @foreach($modulos as $m)
              @if($m->id_modulo==1)

                <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                  <i class="fas fa-fw fa-cog"></i>
                  <span>Permisos admin</span>
                </a>
                <div id="collapse1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{url('almacen/usuario/permiso/cargo')}}">Cargos</a>
                    <a class="collapse-item" href="{{url('almacen/usuario/permiso/usuario')}}">M&oacutedulos</a>
                    <a class="collapse-item" href="{{url('almacen/usuario/permiso/cuenta')}}">Cuentas</a>
                  </div>
                </div>
              </li>
              @endif
              @endforeach


              @foreach($modulos as $m)
                @if($m->id_modulo==2)
                    <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                  <i class="fas fa-fw fa-cog"></i>
                  <span>Empleados</span>
                </a>
                <div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{url('almacen/usuario/registrar')}}">Registro</a>
                    <a class="collapse-item" href="{{url('almacen/nomina/empleado')}}">Lista empleados</a>
                    
                    <!--
                    <a class="collapse-item" href="{{url('almacen/usuario/registrar')}}">Clientes</a>-->
                  </div>
                </div>
              </li>
                 @endif
              @endforeach

               @foreach($modulos as $m)
                @if($m->id_modulo==9)
                    <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse9" aria-expanded="true" aria-controls="collapse9">
                  <i class="fas fa-fw fa-cog"></i>
                  <span>Clientes</span>
                </a>
                <div id="collapse9" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{url('almacen/clienteRegistro')}}">Registro</a>
                    <a class="collapse-item" href="{{url('almacen/cliente/cliente')}}">Lista clientes</a>
                    <a class="collapse-item" href="{{url('almacen/cliente/empresa')}}">Empresas</a>
                    <!--
                    <a class="collapse-item" href="{{url('almacen/usuario/registrar')}}">Clientes</a>-->
                  </div>
                </div>
              </li>
                 @endif
              @endforeach

              @foreach($modulos as $m)
                @if($m->id_modulo==3)
                  <li class="nav-item">
                    <a class="nav-link" href="{{url('almacen/proveedor')}}">
                      <i class="fas fa-fw fa-chart-area"></i>
                      <span>Proveedores</span></a>
                  </li>
                  @endif
              @endforeach


              @foreach($modulos as $m)
                @if($m->id_modulo==5)
                <li class="nav-item">
                    <a class="nav-link" href="{{url('almacen/sede')}}">
                      <i class="fas fa-fw fa-chart-area"></i>
                      <span>Sedes</span></a>
                  </li>
                  @endif
              @endforeach

              @foreach($modulos as $m)
                @if($m->id_modulo==7)

                <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse11" aria-expanded="true" aria-controls="collapse11">
                  <i class="fas fa-fw fa-cog"></i>
                  <span>Pedidos</span>
                </a>
                <div id="collapse11" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{URL::action('facturacionListaPedidosClientes@index',0)}}">Pedidos cliente</a>
                    <a class="collapse-item" href="{{URL::action('facturacionListaPedidosUnoa@index',0)}}">Pedidos unoa</a>
                  </div>
                </div>
                </li>

                @endif
              @endforeach

              @foreach($modulos as $m)
                @if($m->id_modulo==6)
              <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                  <i class="fas fa-fw fa-cog"></i>
                  <span>Inventario admin</span>
                </a>
                <div id="collapse4" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{url('almacen/inventario/producto-sede/productoCompleto')}}">Productos unoa</a>
                    <a class="collapse-item" href="{{url('almacen/inventario/stock')}}">Stock unoa</a>
                    <a class="collapse-item" href="{{url('almacen/inventario/stockClientes')}}">Stock clientes</a>
                  </div>
                </div>
              </li>
                  @endif
              @endforeach



              @foreach($modulos as $m)
                @if($m->id_modulo==8)
                <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse6" aria-expanded="true" aria-controls="collapse6">
                  <i class="fas fa-fw fa-cog"></i>
                  <span>Reportes</span>
                </a>
                <div id="collapse6" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                    <a href="{{url('almacen/reportes/pedido')}}" class="collapse-item" href="">Pedidos por meses</a>
                    <a href="{{url('almacen/reportes/pedidos2')}}" class="collapse-item" href="">Pedidos filtrados</a>
                    <a href="{{url('almacen/reportes/inventarioclientes')}}"class="collapse-item">Inventario clientes</a>
                    <a href="{{url('almacen/reportes/pedido')}}" class="collapse-item" href="">Archivos excel</a>
                  </div>
                </div>
              </li>
                  @endif
              @endforeach

  


      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <div class="input-group" align="right">
              <label>Usuario: {{auth()->user()->name}}</label>
            </div>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
           
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Cerrar sesi&oacuten
                </a>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        

      </div>
      <!-- End of Main Content -->
       <div class="content" align="center">
          <div class="col-md-4" align="center" >

                
                      @if(session()->has('msj'))
                      <div class="alert alert-info" role="alert">
                         <button type="button" class="close" data-dismiss="alert">&times;</button>
                      {{session('msj')}}
                    </div>
                      @endif

                       @if(session()->has('errormsj'))
                        <div class="alert alert-danger" role="alert">
                           <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{session('errormsj')}}
                      </div>
                        @endif

                  </div>
          <div>
                        
                    @yield('contenido')
                    </div>
                    <div class="container">
                        
                    @yield('tabla')
                    </div>
        </div>
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Controler &copy; 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Desea salir?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
          </button>
        </div>
        <div class="modal-body">Seleccione "Salir" si est&aacute seguro de cerrar la sesi&oacuten.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-primary" href="{{url('/logout')}}">Salir</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

  <!-- Page level plugins -->
  <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
  <script src="{{asset('js/demo/chart-pie-demo.js')}}"></script>

</body>

</html>
