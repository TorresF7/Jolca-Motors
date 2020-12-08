<?php 
    session_start();
    
    require 'includes/funciones/funciones.php';
    require 'includes/templates/header.php'; 

    if(isset($_SESSION['usuario']) == true ){
        $_SESSION['usuario'] = null;
        unset($_SESSION['usuario']);
    }

    if(isset($_SESSION['cesto']) == true &&
       isset($_SESSION['cestoCantidad']) == true  &&
       isset($_SESSION['cestosSub'])){
        $productos_cesto = $_SESSION['cesto'];
        $Cantidad = $_SESSION['cestoCantidad'];
        $Sub = $_SESSION['cestosSub'];
    }
?>



<?php if(isset($productos_cesto) == true && count($productos_cesto)> 0): 

    ?>

   <script src="js/sweetalert2.all.min.js"></script>
<script src="js/mensajes.js"></script>  

<div class="container-fluid">
  <div class="bg-white p-3 m-3 font-weight-bold" style="color:#001F3F;font-family: 'Source Sans Pro', sans-serif;font-size:25px;">Listado de Pedido</div>
  <div class="row d-flex justify-content-between flex-wrap-reverse">  
        <div class="col-lg-8 contenedorLista">
            <?php
            $i = 1;
            try{
                require 'includes/funciones/conectar.php';
                require 'vendor/autoload.php';
                $Producto = new Kawschool\Producto;
                foreach($productos_cesto as $codigo):
                    $productos = $Producto->mostrarPorId($codigo);
                    $datos= $productos;
                    if($datos == true):
                        $filas = $datos
            ?>
          <div class="bg-white d-flex justify-content-around p-2 row" style="border-bottom:1px solid #ccc;">
            <div class="d-flex contenedor-imagen justify-content-center align-items-center">
                <img style="width:120px;height:100px;" src="data:image/jpg;base64,<?php echo base64_encode($filas[0]['Imagen']) ; ?>" class="card-img-top" alt="Imagen del Producto">
            </div> 

            <div class="p-3 text-center">
                <div class="font-weight-bold">
                    <?php echo $filas[0]['Nombre'].' - '.$filas[0]['Marca'].' - '. $filas[0]['Descripcion']?>
                </div>
                <div class="d-flex flex-column">
                    <div class="text-secondary"> 
                        <?php echo (int)$_SESSION['cestoCantidad'][$i-1] . ' unidades '?><span class="text-dark font-weight-bold mx-1">x</span>
                        <?php echo ' S/ '.number_format($_SESSION['cestosSub'][$i-1], 2, '.', '')?> 
                    </div>
                    <div>
                        <span>Subtotal : </span><span class="text-success font-weight-bold" style="font-size:20px;"><?php echo ' S/ '.number_format($_SESSION['cestosSub'][$i-1]*$_SESSION['cestoCantidad'][$i-1], 2, '.', '')?><span>   
                    </div>     
                </div>
            </div>  

            <div class="d-flex flex-column align-items-xs-start align-items-lg-end  justify-content-center">
                <?php 
                    echo '
                        <div class="p-2"><a class="boton-editar" href="editar-pedido.php?id='. $i .'"><i class="fas fa-edit mr-2"></i>Editar cantidad</a></div> 
                        <div class="p-1">
                            <form action="eliminar.php?cod='. $i .'"  method="post" id="form-eliminar'.$i.'" style="padding:0!important;">
                                <button type="button" class="boton-eliminar" onclick="ConfirmarEliminacion('.$i.')"><i class="fa fa-times-circle mr-2"></i> Eliminar</button>
                            </form>  
                        </div>';
                ?> 
            </div>               
          </div>
            <?php
                    endif;
                    $i++;
                endforeach;
            }catch(PDOException $e){
                echo 'No se puede acceder a la base de datos'; 
            }                      
            ?>
        </div>
        <?php $Suma=calcularTotal();?>
        <?php if($Suma>0){?>
        <div class="col-lg-3 bg-white contenedorResumen">
            <div class="border-bottom text-center p-3 font-weight-bold" style="font-size:18px;">Resumen de tu pedido</div>
            
            <div class="d-flex justify-content-between p-3 border-bottom">
                <div>Total</div> 
                <div class="font-weight-bold" style="color:rgb(56, 85, 12);"><?php echo 'S/ '.number_format($Suma, 2, '.', '')?></div>
            </div>
            <div class="d-flex justify-content-between p-3 border-bottom">
                <div>Eliminar Lista</div>
                <div class="text-center"><a href="cancelar.php"><button type="button" class="btnLimpiar"><i class="fa fa-trash mr-2"></i>Limpiar</button></a></div>
            </div>
            <div class="d-flex justify-content-between p-3 border-bottom">
                <div>Nro Productos</div>
                <?php $Suma=totalProductos();?>
                <div><?php echo $Suma?></div>
            </div>
            <div>
                <form class="form-EnviarDetPedido" action="finalizar.php" method="post">
                    <button id="botonEnviar" class="btn btn-primary btn-lg btn-block" type="submit">Enviar Pedido</button>
                </form> 
            </div>
            
        </div>    
        <?php }?>   
  </div>                
              
                
</div>
<?php endif;

//
if(isset($productos_cesto) == false||count($productos_cesto) == 0){
    $Suma=0;?>
    <div class="container-fluid">
        <div class="bg-white p-3 m-3 font-weight-bold" style="font-size:20px;font-family: 'Lato', sans-serif;font-size:28px;">Listado de Pedido</div>
        <div class="row d-flex justify-content-between flex-wrap">  
            <div class="col-lg-8 contenedorLista bg-white d-flex flex-column justify-content-center align-items-center flex-wrap">
                <div class="mt-2"><i class="fa fa-shopping-cart text-danger" style="font-size:40px;"></i></div>
                <div class="font-weight-bold text-danger text-center mb-2">No se ha seleccionado ningún producto de nuestro catálogo</div>
                <br><br>
                <div class="font-weight-bold text-danger text-center mb-2">
                    <a href="index.php" class="btn btn-primary">Comprar ahora</a>
                </div>
            </div>
  
            <div class="col-lg-3 bg-white contenedorResumen">
                <div class="border-bottom text-center p-3 font-weight-bold" style="font-size:18px;">Resumen de tu pedido</div>
                <div class="d-flex justify-content-between p-3 border-bottom">
                    <div>Total</div> 
                    <div class="font-weight-bold" style="color:rgb(56, 85, 12);"><?php echo 'S/ '.number_format($Suma, 2, '.', '')?></div>
                </div>
                <div class="d-flex justify-content-between p-3 border-bottom">
                    <div>Eliminar Lista</div>
                    <div class="text-center"><a class="btn-LimpiarDetPedido" href="#"><i class="fa fa-trash mr-2"></i>Limpiar</a></div>
                </div>
                <div class="d-flex justify-content-between p-3 border-bottom">
                    <div>Nro Productos</div>
                    <?php $Suma=totalProductos();?>
                    <div><?php echo $Suma?></div>
                </div>
                <div>
                <form class="form-EnviarDetPedido" action="finalizar.php" method="post">
                    <button id="botonEnviar" class="btn btn-primary btn-lg btn-block" type="submit" disabled>Enviar Pedido</button>
                </form> 
            </div>
            <div>            
        </div>    
    </div> 
        

<?php }?>

<?php require 'includes/templates/footer.php'; ?>