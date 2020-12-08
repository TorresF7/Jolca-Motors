<?php   

session_start();


require 'includes/funciones/funciones.php';
require 'includes/templates/header.php';

        $codigo = filter_var($_GET['id'], FILTER_VALIDATE_INT);
        if(!$codigo){
            die('No es valido');
        }

          require 'vendor/autoload.php';
          $Producto = new Kawschool\Producto;
          $productos = $Producto->mostrarPorId($codigo);

          $oferta = new Kawschool\Oferta;
          $ofertas = $oferta->mostrarPorId($codigo);
              


        if(isset( $_POST['id_producto']) == true &&
          isset($_POST['cantidad-prod']) == true &&
          isset($_POST['valstock']) == true &&
          isset( $_POST['subtotal1']) == true){


     $EU=-1;
        if( isset($_SESSION['cesto']) == true){
            $productos_cesto = $_SESSION['cesto'];
                    
                    $k=0; 
                    $EU=buscarEnCarrito($_POST['id_producto']);
               
        }else{
            $productos_cesto = [];
        }

        if($EU!=-1){
           
           $Cantidad =0;
           $sub =0;
            
          ReagregarCarrito($EU,$_POST['cantidad-prod'],$_POST['subtotal1'],$_POST['valstock']);


         ?>
           <script src="js/sweetalert2.all.min.js"></script>
  
        <script>
        Swal.fire({
          text: 'Se agregó el producto a su carrito de compras',
          type: "success",
        }).then(function() {
                window.location = "index.php";
            });

      </script>
          <?php   
        }else{
          AgregarCarrito($productos_cesto,$_POST['id_producto'],$_POST['cantidad-prod'],$_POST['subtotal1']);
           ?>
              <script src="js/sweetalert2.all.min.js"></script>
  
        <script>
        Swal.fire({
          text: 'Se agregó el producto a su carrito de compras',
          type: "success",
        }).then(function() {
                window.location = "index.php";
            });

      </script>
     

<?php
         

          
         ?>
        
<?php   
    }     
  }

  if($ofertas == true){ ?>
    <div class="container-fluid producto-carrito">
      <div class="row bg-light">
        <div class="col-lg-6 d-flex justify-content-md-center justify-content-lg-end">
          <div class="card" style="margin:20px 0;border:none;">
              <?php foreach($ofertas as $producto):
                $descuento=($producto['Precio']/100)*(100-$producto['Importe']);
              ?>
              <a href="#"><img src="data:image/jpg;base64,<?php echo base64_encode($producto['Imagen_O']) ; ?>" alt="" width="450"></a>
              <div class="card-body text-center mt-3">
                <p class="nombre"><?php echo $producto['Nombre'].' '.$producto['Marca']?></p>
                <p class="descripcion"><?php echo $producto['Descripcion']?></p>
                <div class="precio d-flex justify-content-center" style="font-size:20px;font-weight: 700;">
                    <p style="text-decoration:line-through;">Precio Anterior: S/ </p>
                    <p style="text-decoration:line-through;" class="Precio2"><?php echo $producto['Precio']?></p>
                </div>

                <div class="precio d-flex justify-content-center" style="font-size:20px;font-weight: 700;">
                  <p>Precio ahora: S/ </p>
                  <p><input id="precio" class="precio bg-white d-inline" value="<?php echo number_format($descuento, 2, '.', '')?>" disabled></p>
                </div>
              </div>
            <?php endforeach;?>
            </div>
        </div>

        <div class="col-lg-6 mb-3 d-flex justify-content-center align-items-lg-center">
          <?php foreach($ofertas as $producto):
            $descuento=($producto['Precio']/100)*(100-$producto['Importe']);
          ?>
          <form class="shadow bg-white bg-white text-center rounded" action="descripcion-producto.php?id=<?php echo $producto['IdProducto'];?>" method="post">
            <div class="div-contenedor">   
              <input type="hidden" id="id_producto" name="id_producto" value="<?php echo $producto['IdProducto']?>">
              <input type="hidden" id="subtotal1" name="subtotal1" value="<?php echo $descuento?>">
              <input type="hidden" id="valstock" name="valstock" value="<?php echo $producto['Stock']?>">
              <div class="stock text-center my-2"><span id="stock"> <?php echo $producto['Stock']?></span> unidades disponibles</div>
              <div class="form-group form-error row">   
                <label for="cantidad-prod" class="col-sm-4 col-form-label text-lg-right">Cantidad</label>
                <div class="col-sm-6 col-lg-7">
                    <input type="number" min="1"  pattern="^[0-9]+" class="form-control text-center" id="cantidad-prod"  name="cantidad-prod">
                </div>
              </div>
              <div class="form-group row">
                <label for="subtotal" class="col-sm-4 col-form-label text-lg-right">Subtotal</label>
                <!-- AGREGANDO EL SUBTOTAL -->
                <div id="div-subtotal" class="div-subtotal input-group col-sm-6 col-lg-7">
                
                </div> 
              </div>
              <div><input id="btnAgregarCarrito" type="submit" class="botonAgregarCarrito btn btn-primary btn-lg btn-block" value="Agregar al carrito" disabled="true">  </div>
            </div>  
          </form>   
         <?php endforeach;?>
        </div>
      </div>
    </div>

  <?php   
  }else{
  ?>

<div class="container-fluid producto-carrito">
  <div class="row bg-light">
    <div class="col-lg-6 d-flex justify-content-md-center justify-content-lg-end">
         <div class="card" style="margin:20px 0;border:none;">
            <?php foreach($productos as $producto):?>
            <a href="#"><img src="data:image/jpg;base64,<?php echo base64_encode($producto['Imagen']) ; ?>" alt="" width="450"></a>
            <div class="card-body text-center mt-3">
               <p class="nombre"><?php echo $producto['Nombre'].' '.$producto['Marca']?></p>
               <p class="descripcion"><?php echo $producto['Descripcion']?></p>
               <div class="precio d-flex justify-content-center" style="font-size:20px;font-weight: 700;">
                    <div><label>Precio: S/ </label></div>
                    <div><input id="precio" class="precio bg-white d-inline" value="<?php echo $producto['Precio']?>" disabled></div>
               </div>
            </div>
            <?php endforeach;?>
         </div>
    </div>

    <div class="col-lg-6 mb-3 d-flex justify-content-center align-items-lg-center">
        <?php foreach($productos as $producto):?>
        <form class="shadow bg-white bg-white text-center rounded" 
              action="descripcion-producto.php?id=<?php echo $producto['IdProducto'];?>"
              method="post">
              <div class="div-contenedor">
                <input type="hidden" id="id_producto" name="id_producto" value="<?php echo $producto['IdProducto']?>">
                <input type="hidden" id="subtotal1" name="subtotal1" value="<?php echo $producto['Precio']?>">
                <input type="hidden" id="valstock" name="valstock" value="<?php echo $producto['Stock']?>">
                <div class="stock text-center my-3 p-3"><span id="stock"> <?php echo $producto['Stock']?></span> unidades disponibles</div>
                <div class="form-group form-error row">
                <label for="cantidad" class="col-sm-4 col-form-label text-lg-right">Cantidad</label>
                    <div class="col-sm-6 col-lg-7">
                        <input type="number" min="1" pattern="^[0-9]+" class="form-control text-center" id="cantidad-prod"  name="cantidad-prod">
                    </div>
                </div>
                <div class="form-group row">
                <label for="subtotal" class="col-sm-4 col-form-label text-lg-right subtotal">Subtotal</label>
                    <!-- AGREGANDO EL SUBTOTAL -->
                    <div id="div-subtotal" class="div-subtotal input-group col-sm-6 col-lg-7"> 
                
                    </div> 
                </div>
                <input id="btnAgregarCarrito" type="submit" class="botonAgregarCarrito btn btn-primary btn-lg btn-block" value="Agregar al carrito" disabled="true">
              </div>
            
        </form>   
        <?php endforeach;?>
    </div>
    
  </div>
</div>

<?php   
    }     
   
  
?>

<?php require 'includes/templates/footer.php';?>