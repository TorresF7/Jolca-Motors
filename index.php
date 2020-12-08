<?php 
session_start();
require 'includes/templates/headerBuscar.php';
require 'includes/funciones/funciones.php';
$productosE ='';
?>
<div class="container-fluid">
    <?php require 'includes/templates/menuOfertas.php';?>

    <div class="col-lg-12 bg-light" >
             
        <div class="d-flex flex-wrap justify-content-xl-between bg-white">
            <div class="titulo d-flex align-items-center" style="padding:30 20px!important;margin-left:30px;">
              <span class="font-weight-bold p-4" style="color:#001F3F;font-family: 'Source Sans Pro', sans-serif;font-size:25px;">Nuestros  Productos</span>
            </div> 
        </div>

        <div class="tabla bg-white my-4">
            <!-- TABLA DE PRODUCTOS -->
            <div class="d-flex row p-0 justify-content-center">
              <?php if(isset($_POST['txtBuscarProducto']) == true):?>
                    <?php $buscar_producto = trim($_POST['txtBuscarProducto']);
                        if(!empty($buscar_producto)):?>
                         <?php
                           //TRAYENDO LOS DATOS DEL PRODUCTO ENCONTRADO 
                           require 'vendor/autoload.php';
                            $resultado = new Kawschool\Producto;
                            $productosE = $resultado->buscarProducto($buscar_producto);

                         ?>

                           <!-- PRODUCTO NO ENCONTRADO  EN LA BD-->
                          <?php if($productosE == true): 
                           ?>
                           
                          

                         <!-- PRODUCTO ENCONTRADO EN LA BD-->
                         <?php foreach($productosE as $productoE):
                          $oferta = new Kawschool\Oferta;
                          $ofertas = $oferta->mostrarPorId($productoE['IdProducto']);
                          if($ofertas == true){
                            foreach($ofertas as $productoA):
                                $descuento=($productoA['Precio']/100)*(100-$productoA['Importe']);
                        ?>
                              <div class="card m-3" style="width:18rem;"> 
                                <a href="descripcion-producto.php?id=<?php echo $productoA['IdProducto'];?>"><img src="data:image/jpg;base64,<?php echo base64_encode($productoA['Imagen_O']) ; ?>" class="card-img-top" alt="Imagen del Producto"></a>
                                  <div class="card-body text-center"> 
                                    <p class="nombre"><?php echo $productoA['Nombre'] . ' '. $productoA['Marca'];?></p>
                                    <p class="descripcion"><?php echo $productoA['Descripcion']?></p>
                                    <div class="precio d-flex justify-content-center" style="font-size:20px;font-weight: 700;">
                                      <p style="text-decoration:line-through;">Precio Anterior: S/ </p>
                                      <p style="text-decoration:line-through;" class="Precio2"><?php echo $productoA['Precio']?></p>
                                    </div>

                                    <div class="precio d-flex justify-content-center" style="font-size:20px;font-weight: 700;">
                                      <p>Precio Actual: S/ </p>
                                      <p class="Precio"><?php echo number_format($descuento, 2, '.', '')?></p>
                                    </div> 
                                  </div>
                              </div>

                      <?php endforeach;
                        }else{
                          ?>

                            <div class="card m-3" style="width: 18rem;"> 
                                <a href="descripcion-producto.php?id=<?php echo $productoE['IdProducto'];?>"><img src="data:image/jpg;base64,<?php echo base64_encode($productoE['Imagen']) ; ?>" class="card-img-top" alt="Imagen del Producto" width="200"></a>
                                <div class="card-body text-center"> 
                                    <p class="nombre"><?php echo $productoE['Nombre'] . ' '. $productoE['Marca'];?></p>
                                    <p class="descripcion"><?php echo $productoE['Descripcion']?></p>
                                    <p class="precio">S/ <?php echo $productoE['Precio']?></p>
                                    
                                </div>
                            </div>
                         <?php 
                       }
                       endforeach;?>
                        <?php endif;?>
                        <?php endif;?>
                        
              <?php endif;?>
              
              <!-- LISTADO POR DEFECTO -->
              <?php $productos = listarProductos();
                foreach($productos as $producto): ?>
                    <?php if(isset($_POST['txtBuscarProducto']) == false || $productosE !=true):
                            $descuento=($producto['Precio']/100)*(100-$producto['Importe']);
                       ?>
                        
                        <div class="card m-3" style="width: 18rem;"> 
                            <a href="descripcion-producto.php?id=<?php echo $producto['IdProducto'];?>" id="producto:<?php $producto['IdProducto']?>"><img src="data:image/jpg;base64,<?php echo base64_encode($producto['Imagen_O']) ; ?>" class="card-img-top" alt="Imagen del Producto" width="200"></a>
                            <div class="card-body text-center"> 
                                <p class="nombre"><?php echo $producto['Nombre'] . ' '. $producto['Marca'];?></p>
                                <p class="descripcion"><?php echo $producto['Descripcion']?></p>

                                <div class="precio d-flex justify-content-center" style="font-size:20px;font-weight: 700;">
                                  <p style="text-decoration:line-through;">Precio Anterior: S/ </p>
                                  <p class="Precio2" style="text-decoration:line-through;"><?php echo $producto['Precio']?></p>
                                </div>
                                <div class="precio d-flex justify-content-center" style="font-size:20px;font-weight: 700;">
                                  <p>Precio Actual: S/ </p>
                                  <p class="Precio"><?php echo number_format($descuento, 2, '.', '')?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>       
          <?php endforeach; ?>
            </div>
              <!-- PAGINACION -->
            <div class="d-flex justify-content-center p-3 mt-3">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php 
                              global $producto_por_pagina;
                              global $pagina_actual;
                             
                              $total_paginas = totalPaginas();
                              
                        ?>
                        <!-- ESTABLECEMOS EL BOTON Previus -->
                        <?php if($pagina_actual == 1):?>
                        <li class="page-item disabled"><a class="page-link" href="#" aria-disabled="true">&laquo</a></li>
                        <?php else: ?>
                        <li class="page-item"><a class="page-link" href="?pagina_actual=<?php echo $pagina_actual - 1?>">&laquo</a></li>
                        <?php endif;?>
                        <!-- ESTABLECEMOS EL CICLO -->
                        <?php
                         for($i = 1; $i <= $total_paginas; $i++){
                            if($pagina_actual == $i){
                             echo "<li class='page-item active' aria-current='page'><a class='page-link' href='?pagina_actual=$i'>$i</a></li>"; 
                            }else{
                             echo "<li class='page-item'><a class='page-link' href='?pagina_actual=$i'>$i</a></li>";
                            }
                         }
                        ?>
                        <!-- ESTABLECEMOS EL BOTON  Next -->
                        <?php if($pagina_actual == $total_paginas): ?>
                            <li class="page-item disabled"><a class="page-link" href="#" aria-disabled="true">&raquo;</a></li>
                        <?php else: ?>
                            <li class="page-item"><a class="page-link" aria-disabled="true" href="?pagina_actual=<?php echo $pagina_actual + 1?>">&raquo;</a></li>
                        <?php endif; ?>
                       
                    </ul>
                </nav>
            </div>
        </div>
                     
    </div>

</div>
<?php require 'includes/templates/footer.php';
if(isset($buscar_producto)==true && $buscar_producto!=''){?>

<?php if($productosE == false): ?>
<script>
    Swal.fire({
      text: 'El producto <?php echo $buscar_producto?> no se ha encontrado en nuestro catálogo',
      type: 'info',
      icon: 'info',
    })
</script>

<?php 
endif;
}
?>
