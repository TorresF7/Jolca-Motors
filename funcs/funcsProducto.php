<?php 

function registrarProducto($IdCategoria, $Nombre, $Marca, $Descripcion, $Stock, $Precio, $Imagen){
  require 'vendor/autoload.php';
  $producto = new Kawschool\Producto;
  
  $_params = array(

    'IdCategoria' => $IdCategoria,
    'Nombre' => $Nombre,
    'Marca' => $Marca,
    'Descripcion' => $Descripcion,
    'Stock' => $Stock,
    'Precio' => $Precio,
    'Imagen' => $Imagen, 
);

$producto->registrar($_params);

    if ($producto==true){
        return 1;
        } else {
        return 0;	
    }	
  
}

?>