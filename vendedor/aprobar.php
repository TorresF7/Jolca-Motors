<?php 
    require 'includes/funciones/funciones.php';
    require 'includes/templates/header.php'; 
    require 'includes/templates/barra.php'; 
    require 'includes/templates/navegacion.php';  
    if(isset($_GET['id']) == true){
      $codigo = filter_var($_GET['id'], FILTER_VALIDATE_INT);
      require '../vendor/autoload.php';
      require '../funcs/funcs.php'; 
      $resultado = new Kawschool\Pedido;
      $pedidoCorreo = $resultado->ListarDetalles($codigo);
      
      $pedidos = $resultado->CambiarEstado(3,$codigo);

      $detalles = new Kawschool\Pedido;
      $detallesr=$detalles->ListarDetalles($codigo);

      foreach($detallesr as $aprobar):  
      $producto = new Kawschool\Producto;
      $stockc=$producto->actualizarStock($aprobar['IdProducto'],$aprobar['Cantidad']);
      endforeach; 

      //traer el dni del cliente de pedido
      $resultadoPedido = new Kawschool\Pedido;
                $pedidosdni = $resultadoPedido->SelectPedidoId($codigo);
      // Envio de Correo
      $resultadoCorreo = new Kawschool\Cliente;
        $cliente = $resultadoCorreo->buscarCliente($pedidosdni[0]['Dni']);
        foreach($cliente as $clienteP):
          $email=$clienteP['correo'];
          $nombre=$clienteP['Nombres'];  
          $asunto='JOLCA MOTORS';
          $cuerpo="<div style='font-size:23px;font-weight:750;padding:15px;color:#1F23BA;text-align:center;'>JOLCA MOTORS</div>
                   <div style='font-size:21px;font-weight:700;padding:0px 0px 15px 0px;color:#000000;text-align:center;'>PEDIDO APROBADO</div>
                  <section style='background-color:#f2f2f2;color:#4F4E4D;'>
                    <div style='padding:20px 70px;margin-top:0px 10px 10px 10px;font-size:15px;color:#4F4E4D;'><span style='color:#4f4e4d;'>Estimado ". $clienteP['Nombres'] ." ". $clienteP['Apellidos'] ." su pedido a sido aprobado, 
                    acérquese lo más pronto posible a recoger su producto(s) a nuestro local ubicado:</span> <br>
                    <span style='font-weight:600;color:#000;;'>Dirección:</span><br>
                    <span style='color:#4f4e4d;'>Av. Víctor Raúl Haya de la Torre 1944 - La Victoria</span> <br>
                    <span style='font-weight:600;color:#000;;'>Plazo a recoger su pedido:</span><br>
                    <span style='color:#4f4e4d;'>Los próximos 7 días</span> <br>
                    <span style='font-weight:600;color:#000;'>Contáctanos al:</span><br>
                    <span style='color:#4f4e4d;'>977294200/ 074-600776</span><br>
                    <span style='font-weight:600;color:#000;'>Horarios de atención:</span><br>
                    <span style='color:#4f4e4d;'>Lunes a Sábado : 8:00 am - 6:00 pm </span><br>
                    <span style='color:#4f4e4d;'>El monto a pagar es la suma de <span style='color:green;font-weight:600;'> S/ ".$pedidoCorreo[0]['Total']." </span> incluido IGV por concepto de:</span><br></div>
                      <table style='padding:20px 70px;'>
                        <tr style='background-color:#2560D8;'>
                          <td style='width:400px;text-align:center;padding:7px;color:white;font-weight:300;font-size:14px;border-radius:3px;'>Nombre del Producto</td>
                          <td style='width:100px;text-align:center;padding:7px;color:white;font-weight:300;font-size:14px;border-radius:3px;'>Cantidad</td>
                          <td style='width:100px;text-align:center;padding:7px;color:white;font-weight:300;font-size:14px;border-radius:3px;'>Precio</td>
                          <td style='width:100px;text-align:center;padding:7px;color:white;font-weight:300;font-size:14px;border-radius:3px;'>Subtotal</td>
                        </tr>";
                          foreach($pedidoCorreo as $fila):
                          $cuerpo .= "<tr> 
                                          <td style='width:400px;text-align:center;background-color:white;padding:5px;'>". $fila['Nombre']." ". $fila['Descripcion'] ."</td>
                                          <td style='width:100px;text-align:center;background-color:white;padding:5px;'>". $fila['Cantidad']."</td>
                                          <td style='width:100px;text-align:center;background-color:white;padding:5px;'>S/". $fila['Precio']."</td>
                                          <td style='width:100px;text-align:center;background-color:white;padding:5px;'>S/". $fila['Subtotal']."</td> 
                                      </tr>";
                          endforeach;
                            $cuerpo .= "
                      </table>
                      
                  </section>";
        endforeach;
        enviarEmail($email,$nombre,$asunto,$cuerpo);
      


      echo'<meta http-equiv="refresh" content="0;url=verificar.php">'; 
    ?>

<?php

}

?>

<?php
require 'includes/templates/footer.php'; 
?>  