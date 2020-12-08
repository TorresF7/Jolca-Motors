<?php 
    require 'includes/funciones/funciones.php';
    require 'includes/templates/header.php'; 
    require 'includes/templates/barra.php'; 
    require 'includes/templates/navegacion.php'; 
    if(isset($_GET['id']) == true){
    	$codigo = filter_var($_GET['id'], FILTER_VALIDATE_INT);
 

if(isset($_GET['det']) == true){ 
	$producto = filter_var($_GET['det'], FILTER_VALIDATE_INT);
	  require '../vendor/autoload.php';
      $resultado = new Kawschool\Pedido;
      $pedidos = $resultado->ModificarEstadoDetalle($codigo,$producto,1);
      
      $validar = new Kawschool\Pedido;
      $detallesPedido = $validar->ListarDetalles($codigo);
      if(count($detallesPedido)==0){
        $cancelar = new Kawschool\Pedido;
        $mod = $cancelar->CambiarEstado(2,$codigo);

      }

      $total = new Kawschool\Pedido;
      $totalPedido = $total->CalcularTotal($codigo);

      $cambiar = new Kawschool\Pedido;
      $totalAC = $cambiar->ActualizarTotal($totalPedido,$codigo);

      echo'<meta http-equiv="refresh" content="0;url=procesarPedido.php?id='.$codigo.'">'; 


 }
 }

    
    

?>
<div class="content-wrapper">

	<?php
	 
      ?>
	</div>

  <?php

require 'includes/templates/footer.php'; 
?>  