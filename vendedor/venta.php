<?php 
    require 'includes/funciones/funciones.php';
    require 'includes/templates/header.php'; 
    require 'includes/templates/barra.php'; 
    require 'includes/templates/navegacion.php'; 
    if(isset($_GET['id']) == true){
      $codigo = filter_var($_GET['id'], FILTER_VALIDATE_INT);
      require '../vendor/autoload.php';
      $estado = new Kawschool\Pedido;
      $estadoVal = $estado->SelectPedido($codigo);
      if($estadoVal[0]['Estado']==3 || $estadoVal[0]['Estado']==5 ){
      $resultado = new Kawschool\Pedido;
      $detallesPedido = $resultado->ListarDetalles($codigo);


?>
<script src="../js/mensajes.js"></script>
<div class="content-wrapper" style="font-size:18px;font-family: 'Commissioner', sans-serif;">
    <section class="content-header">
        <div class="shadow rounded p-0 mb-4 mx-2">
           
                    <div class="d-flex flex-wrap justify-content-between bg-white p-3">
                    <?php 
                    /*echo '<a href="listaaprobados.php" class="btn m-2"  style="background-color:#ccc;"><i class="fa fa-angle-left"> Regresar</i></button>
                                                        </a>';*/
                    ?>                                                        
                        <!-- titulo -->
                        <div>
                            <h1>Registrar Venta</h1>
                        </div>
                        <!-- Botones -->
                        <div class="d-flex flex-wrap">
                            <?php 
                                 
                                 if($estadoVal[0]['Estado']==3){
                                echo '<form action="registrarventa.php?id='.$codigo.'"  method="post"  id="form-registrarventa" style="padding:0!important;">
                                        <button type="button" class="btn btn-outline-primary m-2" onclick="ConfirmarVenta()"><i
                                        class="fa fa-file-alt mr-2"></i>Registrar Venta</button>
                                        </form>';

                            
                                echo '<form action="cancelarVenta.php?id='.$codigo.'"  method="post" id="form-cancelarventa" style="padding:0!important;">
                                        <button type="button" class="btn btn-outline-secondary m-2" onclick="ConfirmarCVenta()"><i class="fa fa-window-close mr-2"></i>Cancelar venta</button>
                                        </form>';
                                 } else{
                                    echo '<a href="app/index.php?id='.$codigo.'" class="btn btn-success m-2" target="_blank"><i class="fa fa-file-pdf mr-2"> Comprobante</i></button>
                                                        </a>';
                                 

                                 }                                    
                            ?>
                        </div>
                      
                    </div>
                
               
        </div>


        
            
                    <div class="row">
                        <!--Detales del cliente  -->  
                        <div class="col-sm-12 col-lg-4">  
                        
                            <div class="mx-3 p-2 card shadow rounded">
                                <?php 
                                $resultadoPedido = new Kawschool\Pedido;
                                $pedidos = $resultadoPedido->SelectPedidoId($codigo);
                                ini_set('date.timezone','America/Lima');
                                $time = date('Y-m-d ');
                                ?>
                                <?php foreach($pedidos as $pedido):?>
                                <div class="card-header mb-3" style="background:#f8f9fa;">
                                    <div class="text-center" style="font-family:Roboto;font-weight:bold;font-family: 'Roboto', sans-serif;"><i class="far fa-file-alt mr-3" style="font-size:25px;"></i>Venta</div>                  
                                </div>

                                <div class="mx-4"> 
                                    <div class="d-flex flex-wrap">
                                        <p style="font-weight:700">Fecha: <span class="font-weight-normal"> <?php echo $time ?></span></p>
                                    
                                    </div>
                                    <div class="d-flex flex-column">
                                        <p style="font-weight:700">Nombres: <span class="text-center" style="font-weight:normal;"><?php echo $pedido['Nombres'] . ' '. $pedido['Apellidos']?></span></p>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <p style="font-weight:700">DNI:<span class="text-center" style="font-weight:normal;"><?php echo $pedido['Dni']?></span></p>
                                    </div>
                                </div>
                                <?php endforeach;?>
                                <?php
                                    $total = new Kawschool\Pedido;
                                    $totalPedido = $total->CalcularTotal($codigo);
                                ?>
                                <div class="d-flex flex-column align-items-end p-4">
                                    <p style="font-weight:700; ">Subtotal : <span></span><span style="font-weight:normal;"
                                            class="ml-3"><?php echo number_format($totalPedido*0.82, 2, '.', '')?> </span></p>
                                    <p style="font-weight:700; ">I.G.V. : <span style="font-weight:normal;"
                                            class="ml-3"><?php echo number_format($totalPedido*0.18, 2, '.', '') ?> </span></p>
                                    <p style="font-weight:700; ">Total : <span style="font-weight:normal;"
                                            class="ml-3"><?php echo number_format($totalPedido, 2, '.', '') ?> </span></p>
                                </div>
                            </div>
                        </div>
                        <!-- Tabla -->
                        <div class="col-sm-12 col-lg-8">
                            <div class="mx-3 p-2 bg-white shadow rounded">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th>Nombre Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <?php foreach($detallesPedido as $detallePedido):?>
                                            <tr>
                                                <td class="text-left">
                                                    <?php echo $detallePedido['Nombre'].' '. $detallePedido['Marca']. ' '. $detallePedido['Descripcion']?>
                                                </td>
                                                <td><?php echo $detallePedido['Cantidad']?></td>
                                                <td><?php echo $detallePedido['Precio']?></td>
                                                <?php  endforeach;?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>   
                        </div>
                    </div>
              
     


    </section>
</div>

<?php
}else{

    echo'<meta http-equiv="refresh" content="0;url=index.php">'; 
}
    }
require 'includes/templates/footer.php'; 
?>