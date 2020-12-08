<?php 
  require 'includes/funciones/funciones.php';
  require 'includes/templates/header.php'; 
  require 'includes/templates/barra.php'; 
  require 'includes/templates/navegacion.php'; 
    
    
            require '../vendor/autoload.php';
            $codigo = $_POST['id'];
            $producto = $_POST['det'];

            
            $resultado = new Kawschool\Pedido;
            $pedidos = $resultado->ListarDetallesId($codigo,$producto);
            if(isset($_POST['cantidad-prod']) == true){
              $resultado = new Kawschool\Pedido;
              $detallesPedido = $resultado->ModificarDetalle($codigo,$producto,$_POST['cantidad-prod']);

              $total = new Kawschool\Pedido;
              $totalPedido = $total->CalcularTotal($codigo);
        
              $cambiar = new Kawschool\Pedido;
              $totalAC = $cambiar->ActualizarTotal($totalPedido,$codigo);
            }
            echo'<meta http-equiv="refresh" content="0;url=procesarPedido.php?id='.$codigo.'">'; 
?>

<?php
require 'includes/templates/footer.php'; ?>
