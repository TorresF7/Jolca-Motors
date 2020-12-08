<?php

session_start();


require 'includes/funciones/funciones.php';
require 'includes/templates/header.php'; 
require 'vendor/autoload.php';
require 'funcs/funcs.php';


if( isset($_SESSION['cesto']) == true){  

if(
  isset($_SESSION['usuario']) == true){    

    
    $pedido = new Kawschool\Pedido;
    $Dni=$_SESSION['usuario'];
    $Estado=1;
    $Sub = $_SESSION['cestosSub']; 
    $productos_cesto = $_SESSION['cesto'];
    $CantidadPedido = $_SESSION['cestoCantidad'];
    ini_set('date.timezone','America/Lima');
    $time = date('Y-m-d H:i:s');
        
    $Fecha =  $time;

    $Suma=0.0;
    $CantidadDetalles = count($productos_cesto);
      $w=0;  
        for($w = 0; $w < $CantidadDetalles; $w++){
                
            $Suma=$Suma + ($_SESSION['cestosSub'][$w]*$_SESSION['cestoCantidad'][$w]);
        }            
        
    $k=0;  

        $_params = array(
            'Dni'=>$Dni,
            'Total' =>$Suma,
            'Estado' => $Estado,
            'Fecha' => $Fecha,
        );
        
        $pedido_id =  $pedido->registrar($_params);
     
        
    

        for($i = 0; $i < $CantidadDetalles; $i++){   
             $subtotal=$_SESSION['cestosSub'][$i]*$_SESSION['cestoCantidad'][$i];
            $_params = array(
                "pedido_id" => $pedido_id,
                "producto_id" => $productos_cesto[$i],
                "precio" => $Sub[$i],
                "subtotal" => $subtotal,
                "cantidad" => $CantidadPedido[$i],
            );

            $pedido->registrarDetalle($_params);
        }

        /*$resultado = new Kawschool\Cliente;
        $cliente = $resultado->buscarCliente($Dni);
        foreach($cliente as $clienteP):
        $email=$clienteP['correo'];
        $nombre=$clienteP['Nombres'];
        $asunto='Pedido Realizado- JOLCA MOTORS';
        $cuerpo="Estimado cliente su pedido a sido registrado, en unos días se confimará su pedido para su recojo";

         endforeach;
        enviarEmail($email,$nombre,$asunto,$cuerpo);*/
                

        unset($_SESSION['cesto']);
        unset($_SESSION['cestoCantidad']);
        unset($_SESSION['cestosSub']);
        unset($_SESSION['usuario']);
   
        ?>
      <meta http-equiv="refresh" content="0;url=index.php">
        <?php

}
}    

    ?>
