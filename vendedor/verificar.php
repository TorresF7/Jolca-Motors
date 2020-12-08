<?php 
  session_start();
  if( isset( $_SESSION['usuario']) == true){
    require 'includes/funciones/funciones.php';
    require 'includes/templates/header.php'; 
    require 'includes/templates/barra.php'; 
    require 'includes/templates/navegacion.php'; 
  
?>


<?php 
      require '../vendor/autoload.php';
      $resultado = new Kawschool\Pedido;
      $pedidos = $resultado->ListarPedido();
  ?>

<div class="content-wrapper" style="font-size:18px;font-family: 'Commissioner', sans-serif;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 d-flex flex-wrap justify-content-sm-center">
                <div class="col-sm-6">
                    <h1 style="font-family:font-family: 'Roboto Slab', serif;">Verificar pedidos</h1>
                </div>
                <div class="col-sm-6 d-flex  justify-content-lg-end flex-wrap mt-2">
                    <div class="bg-success mr-2" style="width:40px;height:20px;"></div><span>Stock completo</span>
                    <div class="bg-danger mr-2 ml-2" style="width:40px;height:20px;"></div><span>Falta stock</span>
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
                                if($verificar==0){?>
                                            
                                            <?php
                                            echo ' 
                                            <td><a href="procesarPedido.php?id='. $pedido['IdPedido'] .'" class="btn btn-success m-2">Procesar</a></td>
                
                                            </tr>';
                                }else{?>
                                            
                                            <?php
                                            echo ' 
                                            <td><a href="procesarPedido.php?id='. $pedido['IdPedido'] .'" class="btn btn-danger m-2">Procesar</a></td>
                
                                            </tr>';
                                } 
                                
                           
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
}else
header('location:index.php');
?>