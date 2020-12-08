<?php 
    require 'includes/funciones/funciones.php';
    require 'includes/templates/header.php'; 
    require 'includes/templates/barra.php'; 
    require 'includes/templates/navegacion.php'; 
  
?>


<?php 
      require '../vendor/autoload.php';
      $resultado = new Kawschool\Pedido;
      $pedidos = $resultado->ListarPedidoEstado(3);
  ?>

<div class="content-wrapper" style="font-size:18px;font-family: 'Commissioner', sans-serif;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 d-flex flex-wrap justify-content-sm-center">
                <div class="col-sm-6">
                    <h1 style="font-family:font-family: 'Roboto Slab', serif;">Listado de Pedidos Aprobados</h1>
                </div>

            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="registros" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Nombre del cliente</th>
                                        <th>D.N.I.</th>
                                        <th>Fecha - Hora</th>
                                        <th>Total</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($pedidos as $pedido):
                                    $ver = new Kawschool\Pedido;
                                    $verificar=  $ver->verificar($pedido['IdPedido']);
                                        
                                     ?>

                                    <tr class="text-center">
                                        <td><?php echo $pedido['IdPedido'];?></td>
                                        <td><?php echo $pedido['Nombres'] . ' ' . $pedido['Apellidos'];?></td>
                                        <td><?php echo $pedido['Dni'];?></td>
                                        <td><?php echo $pedido['Fecha']?></td>
                                        <td class="font-weight-bold"><?php echo 'S/'.$pedido['Total']?></td>
                                        <?php 
      
                                            echo ' 
                                            <td><a href="venta.php?id='. $pedido['IdPedido'] .'" class="btn btn-success m-2">Vender</a></td>
                
                                    </tr>';
                     
                                    endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>





</body>

</html>

<?php
require 'includes/templates/footer.php'; 
?>