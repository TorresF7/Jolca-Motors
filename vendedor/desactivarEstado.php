<?php 
    require 'includes/funciones/funciones.php';
    require 'includes/templates/header.php'; 
    require 'includes/templates/barra.php'; 
    require 'includes/templates/navegacion.php'; 
    if(isset($_GET['id']) == true){
        $codigo = filter_var($_GET['id'], FILTER_VALIDATE_INT); 
        require '../vendor/autoload.php';
        $resultado = new Kawschool\Producto; 
        $producto = $resultado->ModificarEstadoProducto($codigo,0);

      echo'<meta http-equiv="refresh" content="0;url=listadoProductos.php">'; 



 }

    
    

?>
<div class="content-wrapper">

</div>

<?php
require 'includes/templates/footer.php'; 
?>  