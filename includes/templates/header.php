<?php 

require 'includes/funciones/funciones2.php';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Krona+One&family=Noto+Sans+KR:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+Pro:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@500&family=Source+Sans+Pro:wght@600;700&family=Source+Serif+Pro:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Commissioner:wght@400;500&family=Nunito:wght@600&family=Source+Sans+Pro&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <title>Jolca Motors</title>
    <link  rel = "shortcut icon"  href = "img/favicon.ico"  type = "image / x-icon" > 
<link  rel = "icon"  href = "img/favicon.ico"  type = "image / x-icon" >    
    
<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<!--  -->
<link rel="stylesheet" href="css/style.css">
<!-- normalize -->
<link rel="stylesheet" href="css/normalize.css">
</head>
<!-- FLEXSLIDER -->
<link rel="stylesheet" href="css/flexslider.css" type="text/css">

<body class="bg-light">
    
<!-- NAVBAR -->
<nav style="background-color:#0C2146;" class="navbar navbar-expand-lg">
    <a class="titulo navbar-brand" href="index.php"><img src="img/logo1.png" width="90" height="55"></a>  
    <!-- BUSCAR -->

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="fa fa-bars bg-white"></span>
  </button>

    <div class="collapse navbar-collapse justify-content-around mx-0"     id="navbarSupportedContent">
       <!-- MENU -->
        <div class="items">
            <ul class="navbar-nav mr-auto">
                <li style="font-weight:700;font-size:20px;" class="nav-item p-2">
                    <a style="color:#fff;"  class="nav-link" href="index.php">Productos</a>
                </li>
                <!-- <li style="font-weight:700;font-size:20px;" class="nav-item dropdown p-2" >
                    <a style="color:#fff;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reportes</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="reporteGenPedidos.php">Reporte General Pedidos</a>
                    </div> 
                </li> -->
            </ul>
        </div>
        <?php 
            // session_start();
            // require '../funciones/funciones.php';

            if(isset($_SESSION['cesto']) == true &&
                isset($_SESSION['cestoCantidad']) == true  &&
                isset($_SESSION['cestosSub'])== true  &&
                count($_SESSION['cesto']) >0
            ){
                $productos_cesto = $_SESSION['cesto'];
                $Cantidad = $_SESSION['cestoCantidad'];
                $Sub = $_SESSION['cestosSub'];
            
        ?>
        <!-- CARRITO -->
        <div class="carrito">
             
            <ul>
                <li class="submenu" style="list-style:none;">
                    <div>
                         
                       <a href="lista-pedido.php"> <img src="img/cart1.png" id="img-carrito"> </a>
                        <a href="lista-pedido.php" class="bt"> 
                            <span class="badge badge-warning text-white navbar-badge"> <?php print cantidadPeliculas(); ?></span>
                        </a>
                    </div>

                    <div id="carrito">       
                        <table id="lista-carrito" class="u-full-width">
                            <thead id="detallePedido" class="detallePedido">
                                <tr>
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php if(isset($productos_cesto) == true):?>
                                <?php
                                    $i = 1;
                                    try{
                                        require 'includes/funciones/conectar.php';
                                        foreach($productos_cesto as $codigo):
                                            $sql = 'SELECT Nombre, Descripcion,Marca, Imagen FROM producto
                                                    WHERE IdProducto = '. $codigo;
                                            $datos = $conexion->query($sql);
                                            if($datos == true):
                                                $filas = $datos->fetchAll();?>
                                            <tr>
                                                <td><img src="data:image/jpg;base64,<?php echo base64_encode($filas[0]['Imagen']) ; ?>" alt="Imagen del Producto" width="80"></td>
                                                <td><?php echo $filas[0]['Nombre'].' '.$filas[0]['Marca'];?></td>
                                                <td><?php echo 'S/ '.number_format($_SESSION['cestosSub'][$i-1], 2, '.', '');?></td>
                                            </tr> 
                                        <?php 
                                            endif;
                                            $i++;
                                        endforeach;     
                                    }catch(PDOException $e){
                                        echo 'No se puede acceder a la base de datos';  
                                    }    
                                ?>
                                

                              <?php endif;?>
                            </tbody>
                        </table>
                        <?php
                            if(isset($productos_cesto) == true): ?>
                                <a href="lista-pedido.php" id="lista-pedido" class="lista-pedido">Listar Pedido</a>
                        <?php
                            else:?>
                                <a href="#" id="lista-pedido" class="lista-pedido" disabled="true">Listar Pedido</a>
                        <?php   
                            endif;
                        ?>
                       
                    </div>
                </li>
            </ul>
            
        </div>
         <?php   
             
             }else{?>
            <div class="carrito">
             
            <ul>
                <li class="submenu" style="list-style:none;">
                    <div>
                         
                        <img src="img/cart1.png" id="img-carrito">    
                        <a  class="bt"> 
                            <span class="badge badge-warning text-white navbar-badge"> <?php print cantidadPeliculas(); ?></span>
                        </a>
                    </div>
            </li>
        </ul>
         </div>


             <?php   
             }
            ?>
   </div> 
</nav>




                              

                      
