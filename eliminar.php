<?php
 session_start();
if(isset($_GET['cod']) == true){

$codigo = filter_var($_GET['cod'], FILTER_VALIDATE_INT);

$pos=$codigo-1;

            $productos_cesto=$_SESSION['cesto'];
            $Cantidad = $_SESSION['cestoCantidad'];
            $sub = $_SESSION['cestosSub'];



   

    unset($productos_cesto[$pos]);
    unset($Cantidad[$pos]);
    unset($sub[$pos]);

    $productos_cesto=array_values($productos_cesto);
    $Cantidad=array_values($Cantidad);
    $sub=array_values($sub);    

    $_SESSION['cesto'] = $productos_cesto;
    $_SESSION['cestoCantidad'] = $Cantidad;
    $_SESSION['cestosSub'] = $sub;

    ?>
<meta http-equiv="refresh" content="0;url=lista-pedido.php">
<?php

}

?>