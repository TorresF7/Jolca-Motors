<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="img/logo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Jolca Motors</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Diego Sanchez Alejos</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>Listas<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="verificar.php" class="nav-link">
                  <i class="far fa-hourglass nav-icon"></i>
                  <p>En Espera</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="listaaprobados.php" class="nav-link">
                <i class="far fa-check-square nav-icon"></i>
                  <p>Aprobados</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="nav-icon fa fa-cubes"></i>
              <p>Productos<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="listadoProductos.php" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Listar Productos</p>
                </a>
              </li>

            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="nav-icon fa fa-file-invoice"></i>
              <p>Reporte<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="reporte.php" class="nav-link">
                <i class="fa fa-clock nav-icon"></i>
                  <p>Tiempo de Atención</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="reporte2.php" class="nav-link">
                <i class="fa fa-file nav-icon"></i>
                  <p> Ventas</p>
                </a>
              </li>
            </ul>
          </li>
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>