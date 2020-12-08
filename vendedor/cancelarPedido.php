<?php 
    require 'includes/funciones/funciones.php';
    require 'includes/templates/header.php'; 
    require 'includes/templates/barra.php'; 
    require 'includes/templates/navegacion.php'; 
    if(isset($_GET['id']) == true){
      $codigo = filter_var($_GET['id'], FILTER_VALIDATE_INT);
      require '../vendor/autoload.php';
      $resultado = new Kawschool\Pedido;
      $pedidos = $resultado->CambiarEstado(2,$codigo);
      echo'<meta http-equiv="refresh" content="0;url=verificar.php">'; 

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