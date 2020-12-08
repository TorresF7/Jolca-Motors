<?php 
session_start();
require 'includes/templates/headerBuscar.php';
require 'includes/funciones/funciones.php';
?>
<div class="container-fluid">
    <?php require 'includes/templates/menuOfertas.php';?>

    <div class="col-lg-12 bg-light">
             
        <div class="d-flex flex-wrap justify-content-xl-between">
            <div class="titulo d-flex align-items-center p-4" style="padding-top:20px">
                <span class="font-weight-bold p-2" style="font-family: 'Lato', sans-serif;font-size:28px;">Otros</span>
            </div>     
        </div>

        <div class="tabla">
            <!-- TABLA DE PRODUCTOS -->
            <div class="d-flex row p-0 justify-content-center">
             
              
              <!-- LISTADO POR DEFECTO -->
                <?php $productos = listarCategorias(5);
                foreach($productos as $producto): ?>
                  <?php if(isset($_POST['txtBuscarProducto']) == false):
                            require 'vendor/autoload.php';
                            $oferta = new Kawschool\Oferta;
                            $ofertas = $oferta->mostrarPorId($producto['IdProducto']);
                        
                            if($ofertas == true){
                                foreach($ofertas as $productoA):
                                    $descuento=($productoA['Precio']/100)*(100-$productoA['Importe']);?>
                                    <div class="card m-3" style="width: 18rem;"> 
                                        <a href="descripcion-producto.php?id=<?php echo $productoA['IdProducto'];?>"><img src="data:image/jpg;base64,<?php echo base64_encode($productoA['Imagen_O']) ; ?>" class="card-img-top" alt="Imagen del Producto" width="200"></a>
                                        <div class="card-body text-center"> 
                                            <p class="nombre"><?php echo $productoA['Nombre'] . ' '. $productoA['Marca'];?></p>
                                            <p class="descripcion"><?php echo $productoA['Descripcion']?></p>
                                            <div class="precio d-flex justify-content-center" style="font-size:20px;font-weight: 700;">
                                                <p>Precio Anterior: S/ </p>
                                                <p class="Precio2"><?php echo $productoA['Precio']?></p>
                                            </div>

                                            <div class="precio d-flex justify-content-center" style="font-size:20px;font-weight: 700;">
                                                <p>Precio Actual: S/ </p>
                                                <p class="Precio"><?php echo number_format($descuento, 2, '.', '')?></p>
                                            </div> 
                                        </div>
                                    </div>

                          <?php endforeach;
                            }else{ ?>
                                <div class="card m-3" style="width: 18rem;"> 
                                    <a href="descripcion-producto.php?id=<?php echo $producto['IdProducto'];?>" id="producto:<?php $producto['IdProducto']?>"><img src="data:image/jpg;base64,<?php echo base64_encode($producto['Imagen']) ; ?>" class="card-img-top" alt="Imagen del Producto" width="200"></a>
                                    <div class="card-body text-center"> 
                                        <p class="nombre"><?php echo $producto['Nombre'] . ' '. $producto['Marca'];?></p>
                                        <p class="descripcion"><?php echo $producto['Descripcion']?></p>
                                        <p class="precio">S/ <?php echo $producto['Precio']?></p>
                                    </div>
                                </div>    
                      <?php }
                        endif;
                endforeach; ?>
            </div>
             <div class="d-flex justify-content-center p-3 mt-3">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php 
                              global $producto_por_pagina;
                              global $pagina_actual;
                             
                              $total_paginas = totalPaginasCategoria(5);
                              
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
<?php require 'includes/templates/footer.php';?>