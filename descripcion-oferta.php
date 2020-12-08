<?php   

session_start();


require 'includes/funciones/funciones.php';
require 'includes/templates/header.php';

        $codigo = filter_var($_GET['id'], FILTER_VALIDATE_INT);
        if(!$codigo){
            die('No es valido');
        }


        require 'vendor/autoload.php';
        $Oferta = new Kawschool\Oferta;
        $ofertas = $Oferta->mostrarPorId($codigo);
              


        if(isset( $_POST['id_oferta']) == true &&
          isset($_POST['cantidad-prod']) == true &&
          isset($_POST['valstock']) == true &&
          isset( $_POST['subtotal1']) == true){


        $EU=-1;
        if( isset($_SESSION['cesto']) == true){
            $ofertas_cesto = $_SESSION['cesto'];     
            $k=0; 
            $EU=buscarEnCarrito($_POST['id_oferta']);
               
        }else{
            $ofertas_cesto = [];
        }

        if($EU!=-1){
           
           $Cantidad =0;
           $sub =0;
            
          ReagregarCarrito($EU,$_POST['cantidad-prod'],$_POST['subtotal1'],$_POST['valstock']);


         ?>
           <meta http-equiv="refresh" content="0;url=index.php">
          <?php   
        }else{
         AgregarCarrito($ofertas_cesto,$_POST['id_oferta'],$_POST['cantidad-prod'],$_POST['subtotal1']);
         ?>
        <meta http-equiv="refresh" content="0;url=index.php">
<?php   
    }     
  }
?>

<div class="container-fluid producto-carrito">
  <div class="row bg-light">
    <div class="col-lg-6 d-flex justify-content-md-center justify-content-lg-end">
         <div class="card" style="margin:20px 0;border:none;">
            <?php foreach($ofertas as $oferta):?>
            <a href="#"><img src="data:image/jpg;base64,<?php echo base64_encode($oferta['Imagen']) ; ?>" alt="" width="450"></a>
            <div class="card-body text-center mt-3">
               <p class="nombre"><?php echo $oferta['NombreOferta']?></p>
               <p class="descripcion"><?php echo $oferta['Descripcion']?></p>
               <div class="precio d-flex justify-content-center" style="font-size:20px;font-weight: 700;">
                    <div><label>Precio: S/ </label></div>
                    <div><input id="precio" class="precio bg-white d-inline" type="number" value="<?php echo $oferta['Precio']?>" disabled></div>
               </div>
            </div>
            <?php endforeach;?>
         </div>
    </div>

    <div class="col-lg-6 mb-3 d-flex justify-content-center align-items-lg-center">
        <?php foreach($ofertas as $oferta):?>
        <form class="shadow bg-white bg-white text-center rounded" 
              action="descripcion-oferta.php?id=<?php echo $oferta['IdOferta'];?>"
              method="post">
              <div class="div-contenedor">
                  <input type="hidden" id="id_oferta" name="id_oferta" value="<?php echo $oferta['IdOferta']?>">
                  <input type="hidden" id="subtotal1" name="subtotal1" value="<?php echo $oferta['Precio']?>">
                  <input type="hidden" id="valstock" name="valstock" value="<?php echo $oferta['Stock']?>">
                  <div class="stock text-center my-3 p-3"><span id="stock"> <?php echo $oferta['Stock']?></span> unidades disponibles</div>
                  <div class="form-group form-error row"> 
                      <label for="cantidad" class="col-sm-4 col-form-label text-lg-right">Cantidad</label>
                      <div class="col-sm-6 col-lg-7">
                          <input type="number" min="0" value="0" class="form-control text-center" id="cantidad-prod"  name="cantidad-prod">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="subtotal" class="col-sm-4 col-form-label text-lg-right">Subtotal</label>
                      <!-- AGREGANDO EL SUBTOTAL -->
                      <div id="div-subtotal" class="div-subtotal input-group col-sm-6 col-lg-7"> 
                
                      </div> 
                  </div>
                  <div><input id="btnAgregarCarrito" type="submit" class="botonAgregarCarrito btn btn-primary btn-lg btn-block" value="AGREGAR AL CARRITO" disabled="true"></div>
              </div> 
            
        </form>   
        <?php endforeach;?>
    </div>
    
  </div>
</div>

<?php require 'includes/templates/footer.php';?>