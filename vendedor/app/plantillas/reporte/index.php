
<?php

function getPlantilla(){

if(isset($_GET['id']) == true){
  $codigo = filter_var($_GET['id'], FILTER_VALIDATE_INT);
  require '../../vendor/autoload.php';
  $resultado = new Kawschool\Pedido;
  $ventas = $resultado->ListarVenta($codigo);
  $detallesPedido = $resultado->ListarDetalles($codigo);
  $clientePedido = $resultado->SelectPedido($codigo);
  $fecha = date('Y/m/d',strtotime($clientePedido[0]['Fecha']));
  $hora = date('H:i',strtotime($clientePedido[0]['Fecha']));
  //<span>Nº Venta:</span><span>'. $ventas[0]['IdVenta'] .' </span>  
  $fechaActual = date('Y/m/d');
  $HoraActual = date('H:m');
  // total pedido
  $total = new Kawschool\Pedido;
  $totalPedido = $total->CalcularTotal($codigo);
  $subtotal = number_format($totalPedido*0.82, 2, '.', '');
  $igv = number_format($totalPedido*0.18, 2, '.', '');
}

/* CODIGO PARA EL RECIBO */

$plantilla .= '<body>';
 
$plantilla.='
    <header>
      <div>
        <div class="header clearfix">
          <div class="logo" width="180px">
            <img src="../../img/jolca.png" width="90">
          </div>
          <div class="company" width="200px">
            <div class="NombreEmpresa"> JOLCA MOTORS </div>
            <div class="Direccion">Av. Víctor Raúl Haya de la Torre 1944</div>
            <div class="Direccion">La Victoria - Chiclayo</div>
            <div class="Telefono">074-600776</div>
          </div>
        </div>
        <div class="contenedorPrincipal">
            <div class="submenuUno" style="width:150px;">
              <span class="cliente">Datos del Cliente</span><br>
              <span class="dtCliente">'. $clientePedido[0]['Nombres']. ' '. $clientePedido[0]['Apellidos'].'</span>
              <span class="dtCliente">'. $clientePedido[0]['Direccion'] .'</span><br>
              <span class="dtCliente">'. $clientePedido[0]['Telefono'] .'</span>
            </div>
            <div class="submenuDos" style="width:180px;">
              <span class="correlativo">Factura Nº '.$ventas[0]['IdPedido'].'</span><br>
              <span class="fecha">Fecha - Hora: Pedido</span><span style="font-size:11px;"> '. $fecha.'-'. $hora.'</span><br>
              <span class="fecha">Fecha - Hora: Facturación</span><span style="font-size:11px;"> '. $fechaActual .'-'.$HoraActual.'</span>
              
            </div>
        </div>
      </div>
    </header>

    <div class="contenedor-tabla">
      <table class="table-rwd">
        <tr style="background:#CCE5FF;">
            <td style="color:#004085;" class="columnaUno">Nº</td>
            <td style="color:#004085;" class="columnaUno">Nombre</td>
            <td style="color:#004085;" class="columnaUno">Cantidad</td>
            <td style="color:#004085;" class="columnaUno">Precio</td>
            <td style="color:#004085;" class="columnaUno">SubTotal</td>
        </tr>';
       $i = 1; 
       foreach($detallesPedido as $fila){
$plantilla.='
        <tr>
            <td class="columna">'. $i.'</td>  
            <td class="columna">'. $fila['Nombre'].' - ' . $fila['Descripcion'] .'</td>
            <td class="columna">'. $fila['Cantidad'] .'</td>
            <td class="columna">S/' . $fila['Precio'] . '</td> 
            <td class="columna">S/' . $fila['Subtotal'] .'</td>
        </tr>';
        $i++;
       }
$plantilla.='
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td>Subtotal</td>
          <td style="color:#545955;font-size:14px;">S/'.$subtotal.'</td>
        </tr> 
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td>I.G.V.</td>
          <td style="color:#545955;font-size:14px;">S/'.$igv.'</td>
        </tr> 
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td style="color:#1d5d79;font-size:16px;font-family: Arial black;">Total</td>
            <td style="color:#1d5d79;font-size:16px;font-family: Arial black;">S/'. $ventas[0]['Total'] .'</td>
        </tr>
      </table> 
    </div>
  </body>';

  return $plantilla;
}
