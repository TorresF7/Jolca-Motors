<?php
 session_start();
require 'includes/templates/header.php';
require 'includes/funciones/funciones.php';

if(isset($_GET['id']) == true){
$codigo = filter_var($_GET['id'], FILTER_VALIDATE_INT);
   require 'vendor/autoload.php';
              $Producto = new Kawschool\Producto;
              $productos = $Producto->mostrarPorId($_SESSION['cesto'][$codigo-1]);
              $oferta = new Kawschool\Oferta;
            $ofertas = $oferta->mostrarPorId($_SESSION['cesto'][$codigo-1]);
$productos = $productos;
$pos=$codigo-1;

            $productos_cesto=$_SESSION['cesto'];
            $Cantidad = $_SESSION['cestoCantidad'];
            $sub = $_SESSION['cestosSub'];

 if($ofertas == true){
 ?>
 <div class="container-fluid producto-carrito">
  <div class="row bg-light">
    <div class="col-lg-6 d-flex justify-content-md-center justify-content-lg-end">
         <div class="card" style="margin:20px 0;border:none;">
            <?php foreach($ofertas as $producto):
              $descuento=($producto['Precio']/100)*(100-$producto['Importe']);
              ?>
            <a href="#"><img src="data:image/jpg;base64,<?php echo base64_encode($producto['Imagen_O']) ; ?>" alt="" width="420" height="330"></a>
            <div class="card-body text-center mt-3">
               <p class="nombre"><?php echo $producto['Nombre'].' '.$producto['Marca']?></p>
               <p class="descripcion"><?php echo $producto['Descripcion']?></p>

                <div class="precio d-flex justify-content-center" style="font-size:20px;font-weight: 700;">
                    <div><label>Precio Anterior: S/ </label></div>
                     <p class="Precio2"><?php echo $producto['Precio']?></p>
               </div>

               <div class="precio d-flex justify-content-center" style="font-size:20px;font-weight: 700;">
                    <div><label>Precio ahora: S/ </label></div>
                    <div><input id="precio" class="precio bg-white d-inline" type="number" value="<?php echo number_format($descuento, 2, '.', '')?>" disabled></div>
               
               </div>
            </div>
            <?php endforeach;?>
         </div>
    </div>

    <div class="col-lg-6 mb-3 d-flex justify-content-center align-items-lg-center">
        <?php foreach($ofertas as $producto):
            $descuento=($producto['Precio']/100)*(100-$producto['Importe']);
          ?>
  
            <form class="shadow bg-white bg-white text-center rounded" action="editar-pedido.php" method="post">

          <div class="div-contenedor">   
            <input type="hidden" id="id_producto" name="id_producto" value="<?php echo $producto['IdProducto']?>">
            <input type="hidden" id="subtotal1" name="subtotal1" value="<?php echo $descuento?>">
            <input type="hidden" id="valstock" name="valstock" value="<?php echo $producto['Stock']?>">
            <div class="stock text-center my-2"><span id="stock"> <?php echo $producto['Stock']?></span> unidades disponibles</div>
            <div class="form-group form-error row">   
                <label for="cantidad" class="col-sm-4 col-form-label text-lg-right">Cantidad</label>
                <div class="col-sm-6 col-lg-7">
                   <input type="hidden" id="pos" name="pos" value="<?php echo $pos?>">
                    <input type="number" min="1" class="form-control text-center" id="cantidad-prod"  name="cantidad-prod" value="<?php echo $Cantidad[$pos]?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="subtotal" class="col-sm-4 col-form-label text-lg-right">Subtotal</label>
                <!-- AGREGANDO EL SUBTOTAL -->
                <div id="div-subtotal" class="div-subtotal input-group col-sm-6 col-lg-7"> 
                
                </div> 
            </div>
            <div>
              <input id="btnAgregarCarrito" type="submit" class="botonAgregarCarrito btn btn-primary btn-lg btn-block" value="Guardar">  
            </div>
          </div>  
        </form>   
        <?php endforeach;?>
    </div>
    
  </div>
</div>

<?php 
 } else{

?>
<div class="container-fluid">
  <div class="row bg-light">
    <div class="col-lg-6 d-flex justify-content-md-center justify-content-lg-end">
         <div class="card" style="margin:20px 0;border:none;">
            <?php foreach($productos as $producto):?>
            <a href="#"><img src="data:image/jpg;base64,<?php echo base64_encode($producto['Imagen']) ; ?>" alt="" width="450"></a>
            <div class="card-body text-center mt-3">

              <p class="nombre"><?php echo $producto['Nombre'].' '.$producto['Marca']?></p>
              <p class="descripcion"><?php echo $producto['Descripcion']?></p>
              <div class="precio" style="font-size:20px;font-weight: 700;">
                <label>Precio: S/</label>
                <input id="precio" class="precio bg-white" type="number" value="<?php echo $producto['Precio']?>" disabled>
              </div>
            </div>
            <?php endforeach;?>
         </div>
    </div>

    <div class="col-lg-6 mb-3 d-flex justify-content-center align-items-lg-center">
        <?php foreach($productos as $producto):?>
        <form class="shadow bg-white bg-white text-center rounded" action="editar-pedido.php" method="post">
          <div class="div-contenedor">  
            <input type="hidden" id="id_producto" name="id_producto" value="<?php echo $producto['IdProducto']?>">
            <input type="hidden" id="subtotal1" name="subtotal1" value="<?php echo $producto['Precio']?>">
            <input type="hidden" id="pos" name="pos" value="<?php echo $pos?>">

            <div class="stock text-center my-3"><span id="stock"> <?php echo $producto['Stock']?> </span>unidades disponibles</div>
            <div class="form-group form-error row">
                <label for="cantidad" class="col-sm-4 col-form-label text-lg-right">Cantidad</label>
                <div class="col-sm-6 col-lg-7">
                    <input type="number" min="1" class="form-control text-center" id="cantidad-prod"  name="cantidad-prod" value="<?php echo $Cantidad[$pos]?>">
                </div>
            </div>
            <div class="form-group row">
            <label for="subtotal"  class="col-sm-4 col-form-label text-lg-right">Subtotal</label>
                <!-- AGREGANDO EL SUBTOTAL -->
                <div id="div-subtotal"  class="div-subtotal input-group col-sm-6 col-lg-7"> 
                
                </div> 
            </div>
            <div>
              <input id="btnAgregarCarrito" type="submit" class="btn btn-primary btn-lg btn-block" value="Guardar">
            </div> 
          </div>
        </form>   
        <?php endforeach;?>
    </div>

  </div>
</div>
<?php
}


            //OBTENIENDO POSICIÓN

                  /* $k=0; 
                    $EU=0;
            foreach( $productos_cesto as $buscar):
                    
                    if( $buscar==$codigo){
                        $EU=$k;
                    }
                   $k++;
                       
                            
                        
                    endforeach; */
            // AGREGANDO SUBTOTAL
                   // var_dump($_SESSION['cestoCantidad'][$EU]);
  
} if(isset($_POST['cantidad-prod']) == true &&
          isset($_POST['pos']) == true &&
        isset($_POST['id_producto']) == true){
 
            // $codigo = $_POST['id_producto'];

            $pos=$_POST['pos'];
           // $codigoSubtotal = $_POST['subtotal1'];


            $Cantidad = $_SESSION['cestoCantidad'];
            $sub = $_SESSION['cestosSub'];

         
            actualizarCarrito($pos,$_POST['cantidad-prod'],$_POST['subtotal1']);
                ?>
                  <script src="js/sweetalert2.all.min.js"></script>
            
                  <script>
                  Swal.fire({
                    text: 'Se modificó la cantidad de productos',
                    type: "success",
                  }).then(function() {
                          window.location = "lista-pedido.php";
                      });

                </script>
               

            <?php

           /* if(isset($_SESSION['cestosSub']) == true){
              $_SESSION['cestosSub'][$pos] = $_POST['subtotal1'] * $_POST['cantidad-prod'];
            
               
            }

            //  AGREGANDO CANTIDAD
 
             if(isset($_POST['cantidad-prod']) == true){
              
                $_SESSION['cestoCantidad'][$pos] = $_POST['cantidad-prod'];
              
             }*/



}

?>



<?php require 'includes/templates/footer.php';?>