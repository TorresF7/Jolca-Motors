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
      if($estadoVal[0]['Estado']==1){
           
      $resultado = new Kawschool\Pedido;
      $detallesPedido = $resultado->ListarDetalles($codigo);
      
?>
<script src="../js/mensajes.js"></script>
<div class="content-wrapper" style="font-size:18px;font-family: 'Commissioner', sans-serif;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-lg-12">
                    <!-- Mostrar mensaje para realización de venta-->
                    <?php 
              $ver = new Kawschool\Pedido;
              $verificar=  $ver->verificar($codigo);
            ?>
                    <div class="d-flex flex-wrap justify-content-between bg-white p-3">
                        <!-- titulo -->
                        <div>
                            <h1>Pedido Nro: <?php  echo $codigo ?></h1>
                        </div>
                        <!-- Botones -->
                        <div>
                            <!-- Validar opciones-->
                            <?php if($verificar==0){?> 
                            <div class="d-flex flex-wrap">
                                <?php 
                               

                                       echo '<form action="aprobar.php?id='.$codigo.'"  method="post" id="form-aprobarPedido" style="padding:0!important;">
                                               <button type="button" class="btn btn-outline-primary m-2" onclick="ConfirmarAprobacion()"><i
                                               class="fa fa-file-alt mr-2"></i>Aprobar pedido</button>
                                             </form>';

                            
                                      echo '<form action="cancelarPedido.php?id='.$codigo.'"  method="post" id="form-cancelarpedido" style="padding:0!important;">
                                               <button type="button" class="btn btn-outline-secondary m-2" onclick="ConfirmarCancelacion()"><i class="fa fa-window-close mr-2"></i>Cancelar pedido</button>
                                             </form>';
                                              ?>
                            </div>

                            <?php
                                 }else{?> 

                            <div class="d-flex flex-wrap">

                                <?php 
                                       echo '<form action="importarVenta.php?id='.$codigo.'"  method="post" id="form-importarPedido" style="padding:0!important;">
                                       <button type="button" class="btn btn-outline-primary m-2" onclick="ConfirmarImportacion()"><i class="fa fa-file-import mr-2"></i>Importar pedido</button>
                                     </form>'; 

                                       echo '<form action="cancelarPedido.php?id='.$codigo.'"  method="post" id="form-cancelarpedido" style="padding:0!important;">
                                               <button type="button" class="btn btn-outline-secondary m-2" onclick="ConfirmarCancelacion()"><i class="fa fa-window-close mr-2"></i>Cancelar pedido</button>
                                             </form>'; 
                       
                                ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- Estado -->
                    <div class="bg-white p-2 mb-2">

                        <?php if($verificar==0){?>
                        <div class="mx-4 text-center alert alert-success"
                            style="font-weight:700 ;font-family: 'Commissioner', sans-serif;">Estado: Se puede
                            aprobar pedido </div><?php
                            }else{?>
                        <div class="mx-4 text-center alert alert-danger"
                            style="font-weight:700 ;font-family: 'Commissioner', sans-serif;">Estado: No se puede
                            aprobar pedido </div><?php
                                } ?>

                    </div>

                    <div class="bg-white p-2">
                        <div class="m-4 text-center font-weight-bold p-2"
                            style="font-size:20px;border-bottom:2px solid black;"><span>Detalles del Cliente</span>
                        </div>
                        <div class="d-flex justify-content-between flex-wrap mx-4">
                            <?php 
                $resultadoPedido = new Kawschool\Pedido;
                $pedidos = $resultadoPedido->SelectPedidoId($codigo);
                ?>
                            <?php foreach($pedidos as $pedido):?>
                            <p>Nombre: <?php echo $pedido['Nombres'] . ' '. $pedido['Apellidos']?></p>
                            <p>DNI: <?php echo $pedido['Dni']?></p>
                            <p>Teléfono: <?php echo $pedido['Telefono']?></p>
                            <?php endforeach;?>

                            <?php $estadoP = new Kawschool\Pedido;
                                 $FechaP = $estadoP->ListarPedido();
                                 $fecha = date('Y-m-d',strtotime($FechaP[0]['Fecha']));
                                 $hora = date('H:i:s',strtotime($FechaP[0]['Fecha'])); 
                            ?>
                            <p>Fecha y hora: <?php echo $fecha,', ', $hora ?></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABLA -->
        <div class="mx-2">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="p-2">
                            <div class="text-center font-weight-bold p-2 m-4"
                                style="font-size:20px;border-bottom:2px solid black;"><span>Detalles Pedido</span></div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: 400px;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead class="text-center">
                                    <tr>
                                        <th>Nº</th>
                                        <th class="text-left">Nombre</th>
                                        <th>Stock</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Subtotal</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php
                                    $w=0;
                                    foreach($detallesPedido as $detallePedido):?>
                                    <tr>
                                        <td><?php echo $w + 1; ?></td>
                                        <td class="text-left">
                                            <?php echo $detallePedido['Nombre'].' '. $detallePedido['Marca']. ' '. $detallePedido['Descripcion']?>
                                        </td>
                                        <td><?php echo $detallePedido['Stock'];?></td>
                                        <td><?php echo $detallePedido['Cantidad']?></td>
                                        <td><?php echo $detallePedido['Precio']?></td>
                                        <td><?php echo $detallePedido['Subtotal']?></td>
                                        <?php if($detallePedido['Estado']==1){
                                            echo '<td><span class="p-1 bg-success m-2" style="font-size: 15px;">Activado</span></td>';
                                          
                                        }else{
                                            echo '<td><span class="p-1 bg-danger m-2" style="font-size: 15px;">Desactivado</span></td>';
                                        }
                                            
                                        ?>
                                       
                                        <!-- <td class="text-danger">No se puede realizar venta</td> -->
                                        <td>
                                            <?php 
                                                echo '<div class="d-flex justify-content-center">
                                                        <div><a href="#" data-id-pedido="'.$codigo.'"  data-id-producto="'.$detallePedido['IdProducto'].'" data-cantidad="'.$detallePedido['Cantidad'] .'" class="btn btn-success m-2 btnModificarCantidadPedido"><i class="fas fa-edit"></i></a></div>
                                                        

                                                        <form action="EliminarDetalle.php?id='.$codigo.'&det='.$detallePedido['IdProducto'].'"  method="post" id="form-eliminarDetalle'.$w.'" style="padding:0!important;">
                                                        <button type="button" class="btn btn-danger m-2" onclick="ConfirmarEliminacionDetalle('.$w.')"><i class="fa fa-trash-alt"></i></button>
                                                        </form>    
                                                        
                                                        </div>';
                                            ?>
                                        </td>
                                    </tr>
                                    <?php 
                                    $w++;
                                endforeach;?>
                                </tbody>
                                <tfoot>
                                    <?php
                                    $total = new Kawschool\Pedido;
                                    $totalPedido = $total->CalcularTotal($codigo);
                                ?>
                                    <tr class="ultimo-elemento mb-4">
                                        <td colspan="5" class="text-center font-weight-bold">Total general del Pedido
                                        </td>
                                        <td class="text-center font-weight-bold"><?php echo 'S/ '.number_format($totalPedido, 2, '.', '')

                                    ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>

    </section>
</div>

<!-- Modal -->
<div class="modal fade" id="modificarDetallePedido" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar detalle del pedido</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="modificarDetalle.php" method="post">

        <input type="hidden" name="id" id="id_pedido">

        <input type="hidden" name="det" id="id_producto">
            
        <div class="form-group">
            <label for="cantidadd_producto">Cantidad</label>
            <input type="number" class="form-control text-center" min="1" name="cantidad-prod" id="cantidad_producto" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
 		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        </form>
      </div>
    </div>
  </div>
</div>


<?php
}else{
    $estadoEli = new Kawschool\Pedido;
      $estadovalEli = $estadoEli->SelectPedido($codigo);
      $validar = new Kawschool\Pedido;
      $cantidadPedido = $validar->ListarDetalles($codigo);
      if($estadovalEli[0]['Estado']==2 && count($cantidadPedido)==0){
       ?>
        <div class="content-wrapper" style="font-size:21px;font-family: 'Commissioner', sans-serif;">
            <section class="content-header">
            <div class="mx-4 text-center alert alert-danger"
                            style="font-weight:700 ;font-family: 'Commissioner', sans-serif;">Estado: Se Cancelo el pedido por eliminación de todos sus detalles </div>
            </section>
        </div>
    <?php
    echo'<meta http-equiv="refresh" content="5;url=index.php">'; 
    }else{
      echo'<meta http-equiv="refresh" content="0;url=index.php">'; 
    }
    }
}
require 'includes/templates/footer.php'; 
?>