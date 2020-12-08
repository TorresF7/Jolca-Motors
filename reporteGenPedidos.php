<?php 
    require 'includes/funciones/funciones.php';
    require 'includes/templates/header.php'; 
  session_start();
?>

<!-- Font Awesome -->
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">


  <?php 
      require 'vendor/autoload.php';
      $resultado = new Kawschool\Pedido;
      $pedidos = $resultado->ListarPedido();
  ?>   


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Listado de Pedidos</h1>
          </div>
          
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="registros" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Código</th>
                      <th>Nombre del cliente</th>
                      <th>D.N.I.</th>
                      <th>Fecha - Hora</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($pedidos as $pedido):?>
                            <tr class="text-center">
                                <td><?php echo $pedido['IdPedido'];?></td>  
                                <td><?php echo $pedido['Nombres'] . ' ' . $pedido['Apellidos'];?></td>  
                                <td><?php echo $pedido['Dni'];?></td>
                                <td><?php echo $pedido['Fecha']?></td>
                                <td class="font-weight-bold"><?php echo 'S/'.$pedido['Total']?></td>
                            </tr>
                        <?php endforeach;?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Código</th>
                      <th>Nombre del cliente</th>
                      <th>D.N.I.</th>
                      <th>Fecha - Hora</th>
                      <th>Total</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->



<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
$(function() {
    $("#registros").DataTable({
        "responsive": true,
        "pageLength": 7,
        "autoWidth": false,
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        'language': {
            paginate: {
                next: '&raquo',
                previous: '&laquo',
                last: 'Ultimo',
                first: 'Primero'
            },
            info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
            // NO HAY REGISTROS
            emptyTable: 'No hay registros',
            infoEmpty: '0 Registros',
            // BUSCAR
            search: 'Buscar:'
        }
    });
});
</script>
</body>
</html>


