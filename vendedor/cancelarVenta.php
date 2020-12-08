<?php 
    require 'includes/funciones/funciones.php';
    require 'includes/templates/header.php'; 
    require 'includes/templates/barra.php'; 
    require 'includes/templates/navegacion.php'; 
    if(isset($_GET['id']) == true){
      $codigo = filter_var($_GET['id'], FILTER_VALIDATE_INT);
      require '../vendor/autoload.php';
      $resultado = new Kawschool\Pedido;
      $pedidos = $resultado->CambiarEstado(6,$codigo);

      $detalles = new Kawschool\Pedido;
      $detallesr=$detalles->ListarDetalles($codigo);

      foreach($detallesr as $aprobar):  
      $producto = new Kawschool\Producto;
      $stockc=$producto->actualizarStock($aprobar['IdProducto'],($aprobar['Cantidad'])*-1);
      endforeach;
      echo'<meta http-equiv="refresh" content="0;url=listaaprobados.php">'; 
    ?>

<?php

}

?>
<div class="content-wrapper">
    <!--  echo'<meta http-equiv="refresh" content="0;url=procesarPedido.php?id='.$codigo.'">'; -->
</div>

<?php

require 'includes/templates/footer.php'; 
?>  