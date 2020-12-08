<?php 
    require 'includes/funciones/funciones.php';
    require 'includes/templates/header.php'; 
 
    if(isset($_GET['id']) == true){
      $codigo = filter_var($_GET['id'], FILTER_VALIDATE_INT);
      require '../vendor/autoload.php';
      $resultado = new Kawschool\Pedido;
      $pedidos = $resultado->CambiarEstado(5,$codigo);

      
      $usuario=1;
      ini_set('date.timezone','America/Lima');
      $time = date('Y-m-d H:i:s');  
      $Fecha =  $time;

      $total = new Kawschool\Pedido;
      $totalPedido = $total->CalcularTotal($codigo);

      $venta = new Kawschool\Venta;
      $_array = array(
        "IdPedido" => $codigo,
        "IdUsuario" => $usuario,
        "Fecha" => $Fecha,
        "Total" => $totalPedido
      );
   
    $valor = $venta->registrar($_array);
    echo'<meta http-equiv="refresh"  content="0;url=venta.php?id='. $codigo .'">'; 
    
    ?>
    
    <?php

    
    ?>
    
    <?php

    


}

?>
<div class="content-wrapper">
  <!--  echo'<meta http-equiv="refresh" content="0;url=procesarPedido.php?id='.$codigo.'">'; -->
	</div>
    <?php


?>    