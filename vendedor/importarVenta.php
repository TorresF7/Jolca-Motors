<?php 
    require 'includes/funciones/funciones.php';
    require 'includes/templates/header.php'; 
    require 'includes/templates/barra.php'; 
    require 'includes/templates/navegacion.php'; 
    if(isset($_GET['id']) == true){
      $codigo = filter_var($_GET['id'], FILTER_VALIDATE_INT);
      require '../vendor/autoload.php';
      $resultado = new Kawschool\Pedido;
      $pedidos = $resultado->ImportarPedido($codigo);

      $Cantidad = [];
      $precio = []; 
      $producto = [];
      $i=0;
      ini_set('date.timezone','America/Lima');
      $time = date('Y-m-d H:i:s');  
      $Fecha =  $time;
      $usuario=1;

      foreach($pedidos as $importar):
        $cantidad[$i]=$importar['Cantidad']-$importar['Stock'];
        $precio[$i]=$importar['Precio'];
        $producto[$i]=$importar['IdProducto'];
        $i++;   
        if($importar['Stock']<$importar['Cantidad']){
        $_params = array(
            "pedido_id" => intval($codigo),
            "idUsuario" => intval($usuario),
            "Fecha" => $Fecha,
            "producto_id" => intval($importar['IdProducto']),
            "cantidad" => ($importar['Cantidad']-$importar['Stock'])
        );

        


        $importacion = new Kawschool\Pedido;
        $valor=$importacion->registrarImportacion($_params);
      }
    endforeach;
    $estado = new Kawschool\Pedido;
    $estado->CambiarEstado(4,$codigo);
    echo'<meta http-equiv="refresh" content="0;url=verificar.php">'; 

    ?>

<?php



?>
<div class="content-wrapper">
<section class="content-header">
<?php 
 

?>            
	</div>
</section>
<?php }
?>  
<?php

require 'includes/templates/footer.php'; 
?>  