<?php 
session_start();
require 'includes/templates/header.php';
require 'includes/funciones/funciones.php';
?>
<div class="container-fluid">

<!-- <div class="col-lg-12 p-0">
    <div class="contenedorBanner">
    </div>
</div> -->


<div class="col-lg-12 bg-light">
         
    <div class="d-flex flex-wrap justify-content-xl-between">
        <div class="titulo d-flex align-items-center p-4" style="padding-top:20px">
            <span class="font-weight-bold p-2" style="font-family: 'Lato', sans-serif;font-size:28px;">Buscar  -  Oferta</span>
        </div>

      <!-- BUSCAR 
        <form action="index.php" method="post">
            <div class="input-group">
                <input class="form-control" type="text" maxlength="70" name="txtBuscarProducto" placeholder="Ingrese el nombre" size="30">
                <div class="input-group-append">
                    <button id="botonBuscar" class="btn btn-primary" type="submit"><i class="fa fa-search mr-1" aria-hidden="true"></i></button>
                </div>
            </div>
        </form>
        -->
    </div>

    <div class="tabla">
        <!-- TABLA DE PRODUCTOS -->
        <div class="d-flex row p-0 justify-content-center">

          <!-- LISTADO POR DEFECTO -->
          <?php $ofertas = listarOfertas();
            foreach($ofertas as $oferta): ?>
                
            
                    <div class="card m-3" style="width: 18rem;"> 
                        <a href="descripcion-oferta.php?id=<?php echo $oferta['IdOferta'];?>" id="oferta:<?php $oferta['IdOferta']?>"><img src="data:image/jpg;base64,<?php echo base64_encode($oferta['Imagen']) ; ?>" class="card-img-top" alt="Imagen de la Oferta" width="200"></a>
                        <div class="card-body text-center"> 
                            <p class="nombre"><?php echo $oferta['NombreOferta']?></p>
                            <p class="descripcion"><?php echo $oferta['Descripcion']?></p>
                            <p class="precio">S/ <?php echo $oferta['Precio']?></p>
                        </div>
                    </div>
                  
                    
            <?php endforeach; ?>
        </div>

        <!-- PAGINACION -->
        <div class="d-flex justify-content-center p-3 mt-3">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php 
                          global $producto_por_pagina;
                          global $pagina_actual;
                         
                          $total_paginas = totalPaginas();;
                         
                    ?>
                    <!-- ESTABLECEMOS EL BOTON Previus -->
                    <?php if($pagina_actual == 1):?>
                    <li class="page-item disabled"><a class="page-link" href="#" aria-disabled="true">&laquo</a></li>
                    <?php else: ?>
                    <li class="page-item"><a class="page-link" href="?pagina_actual=<?php echo $pagina_actual - 1 ?>">&laquo</a></li>
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