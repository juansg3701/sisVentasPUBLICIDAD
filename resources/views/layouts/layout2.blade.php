<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>1A</title>

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
    <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}">
          <div class="sidebar-brand-icon rotate-n-15">
          <img src="{{asset('img/logo1.jpeg')}}" width="35" height="35">
        </div>
        <div class="sidebar-brand-text mx-3"> 1A</div>
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
                    <a class="collapse-item" href="{{url('almacen/usuario/permiso/usuario')}}">Módulos</a>
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
                  <span>Cuentas</span>
                </a>
                <div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{url('almacen/usuario/registrar')}}">Registrarse</a>
                    <a class="collapse-item" href="{{url('almacen/nomina/empleado')}}">Empleados</a>
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
                @if($m->id_modulo==4)
                 <li class="nav-item">
                    <a class="nav-link" href="">
                      <i class="fas fa-fw fa-chart-area"></i>
                      <span>Devoluciones</span></a>
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
                @if($m->id_modulo==6)
              <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                  <i class="fas fa-fw fa-cog"></i>
                  <span>Inventario</span>
                </a>
                <div id="collapse4" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{url('almacen/inventario/producto-sede/productoCompleto')}}">Productos</a>
                    <a class="collapse-item" href="{{url('almacen/inventario/proveedor-sede')}}">Stock</a>
                   <!-- <a class="collapse-item" href="">Movimiento entre sedes</a>
                    <a class="collapse-item" href="">Corte de inventario</a>-->
                  </div>
                </div>
              </li>
                  @endif
              @endforeach

              @foreach($modulos as $m)
                @if($m->id_modulo==7)
               <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapse5">
                  <i class="fas fa-fw fa-cog"></i>
                  <span>Pedidos</span>
                </a>
                <div id="collapse5" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="">Pedido cliente</a>
                    <a class="collapse-item" href="">Pedido proveedor</a>
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
                    <a class="collapse-item" href="">Pedidos</a>
                    <a class="collapse-item" href="">Productos</a>
                  </div>
                </div>
              </li>
                  @endif
              @endforeach


            
                  <li class="nav-item">
                  <a class="nav-link" href="{{url('/logout')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Cerrar sesión</span></a>
                </li>
  


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

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
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
            <span>Copyright &copy; Your Website 2020</span>
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
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
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
