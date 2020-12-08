<?php 
    require 'includes/funciones/funciones.php';
    require 'includes/templates/header.php'; 
    require 'includes/templates/barra.php'; 
    require 'includes/templates/navegacion.php'; 
  
?>


<?php 
      require '../vendor/autoload.php';
      $resultado = new Kawschool\Producto;
      $productos = $resultado->mostrarProducto();
?> 
<script src="../js/mensajes.js"></script>
<div class="content-wrapper" style="font-size:18px;font-family: 'Commissioner', sans-serif;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 d-flex flex-wrap justify-content-sm-center">
                <div class="col-sm-6">
                    <h1 style="font-family:font-family: 'Roboto Slab', serif;">Listado Productos</h1>
                </div>
                <div class="col-sm-6 d-flex  justify-content-lg-end flex-wrap mt-2">
                    <a href="registrarProducto.php" class="btn btn-primary"><i class="fa fa-file mr-2"></i>Nuevo</a>
                </div> 
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="registros" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th >Nombre del Producto</th>
                                        <th>Categoria</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead> 
                                <tbody>
                                    <?php 
                                    $w=0;
                                    foreach($productos as $fila):?>
                                        <?php if($fila['Estado'] == 1):?>
                                            <?php if($fila['IdCategoria'] == 1):?>
                                                <tr class="text-center">
                                                    <td><?php echo $fila['IdProducto'];?></td>
                                                    <td><?php echo $fila['Nombre'].'  '.$fila['Marca'].$fila['Descripcion'];?></td>
                                                    <td><?php echo 'Neumaticos';?></td>
                                                    <td><?php echo $fila['Stock'];?></td>
                                                    <td><?php echo 'S/ '. $fila['Precio'];?></td>
                                                    <td><span class="p-1 bg-success m-2" style="font-size: 15px;">Activado</span></td>
                                                    <td><?php echo '<a href="modificarProducto.php?id='. $fila['IdProducto'] .'" class="btn btn-success"><i class="fas fa-edit"></i></a>'?>
                                                    <?php 
                                                        echo '<a href="desactivarEstado.php?id='.$fila['IdProducto'].'" class="btn btn-danger"><i class="fa fa-window-close"></i></button>
                                                        </a>';
                                                        ?>  
                                                    </td>
                                                </tr>
                                            <?php elseif($fila['IdCategoria'] == 2):?>
                                                <tr class="text-center">
                                                    <td><?php echo $fila['IdProducto'];?></td>
                                                    <td><?php echo $fila['Nombre'].'  '.$fila['Marca'].$fila['Descripcion'];?></td>
                                                    <td><?php echo 'Plomos';?></td>
                                                    <td><?php echo $fila['Stock'];?></td>
                                                    <td><?php echo 'S/ '. $fila['Precio'];?></td>
                                                    <td><span class="p-1 bg-success m-2" style="font-size: 15px;">Activado</span></td>
                                                    <td><?php echo '<a href="modificarProducto.php?id='. $fila['IdProducto'] .'" class="btn btn-success"><i class="fas fa-edit"></i></a>'?>
                                                    <?php 
                                                        echo '<a href="desactivarEstado.php?id='.$fila['IdProducto'].'"  class="btn btn-danger"><i class="fa fa-window-close"></i></button>
                                                        </a>';
                                                        ?>  
                                                    </td>
                                                </tr>
                                            <?php elseif($fila['IdCategoria'] == 3):?>
                                                <tr class="text-center">
                                                    <td><?php echo $fila['IdProducto'];?></td>
                                                    <td><?php echo $fila['Nombre'].'  '.$fila['Marca'].$fila['Descripcion'];?></td>
                                                    <td><?php echo 'Aceites';?></td>
                                                    <td><?php echo $fila['Stock'];?></td>
                                                    <td><?php echo 'S/ '. $fila['Precio'];?></td>
                                                    <td><span class="p-1 bg-success m-2" style="font-size: 15px;">Activado</span></td>
                                                    <td><?php echo '<a href="modificarProducto.php?id='. $fila['IdProducto'] .'" class="btn btn-success"><i class="fas fa-edit"></i></a>'?>
                                                    <?php 
                                                        echo '<a href="desactivarEstado.php?id='.$fila['IdProducto'].'" class="btn btn-danger"><i class="fa fa-window-close"></i></button>
                                                        </a>';
                                                        ?>  
                                                    </td>
                                                </tr>
                                            <?php elseif($fila['IdCategoria'] == 4):?>
                                                <tr class="text-center">
                                                    <td><?php echo $fila['IdProducto'];?></td>
                                                    <td><?php echo $fila['Nombre'].'  '.$fila['Marca'].$fila['Descripcion'];?></td>
                                                    <td><?php echo 'Frenos';?></td>
                                                    <td><?php echo $fila['Stock'];?></td>
                                                    <td><?php echo 'S/ '. $fila['Precio'];?></td>
                                                    <td><span class="p-1 bg-success m-2" style="font-size: 15px;">Activado</span></td>
                                                    <td><?php echo '<a href="modificarProducto.php?id='. $fila['IdProducto'] .'" class="btn btn-success"><i class="fas fa-edit"></i></a>'?>
                                                    <?php 
                                                        echo '<a href="desactivarEstado.php?id='.$fila['IdProducto'].'" class="btn btn-danger"><i class="fa fa-window-close"></i></button>
                                                        </a>';
                                                        ?>  
                                                    </td>
                                                </tr>
                                            <?php else:?>
                                                <tr class="text-center">
                                                    <td><?php echo $fila['IdProducto'];?></td>
                                                    <td><?php echo $fila['Nombre'].'  '.$fila['Marca'].$fila['Descripcion'];?></td>
                                                    <td><?php echo 'Otros';?></td>
                                                    <td><?php echo $fila['Stock'];?></td>
                                                    <td><?php echo 'S/ '. $fila['Precio'];?></td>
                                                    <td><span class="p-1 bg-success m-2" style="font-size: 15px;">Activado</span></td>
                                                    <td><?php echo '<a href="modificarProducto.php?id='. $fila['IdProducto'] .'" class="btn btn-success"><i class="fas fa-edit"></i></a>'?>
                                                    <?php 
                                                        echo '<a href="desactivarEstado.php?id='.$fila['IdProducto'].'" class="btn btn-danger"><i class="fa fa-window-close"></i></button>
                                                        </a>';
                                                        ?>  
                                                    </td>
                                                </tr>
                                            <?php endif;?>
                                        <?php else:?>
                                            <?php if($fila['IdCategoria'] == 1):?>
                                                <tr class="text-center">
                                                    <td><?php echo $fila['IdProducto'];?></td>
                                                    <td><?php echo $fila['Nombre'].'  '.$fila['Marca'].$fila['Descripcion'];?></td>
                                                    <td><?php echo 'Neumaticos';?></td>
                                                    <td><?php echo $fila['Stock'];?></td>
                                                    <td><?php echo 'S/ '. $fila['Precio'];?></td>
                                                    <td><span class="p-1 bg-danger m-2" style="font-size: 15px;">Desactivado</span></td>
                                                    <td><?php echo '<a href="modificarProducto.php?id='. $fila['IdProducto'] .'" class="btn btn-success"><i class="fas fa-edit"></i></a>'?>
                                                    <?php 
                                                        echo '<a href="activarEstado.php?id='.$fila['IdProducto'].'"  class="btn btn-primary"><i class="fas fa-check"></i></i></button>
                                                        </a>';
                                                        ?>  
                                                    </td>
                                                </tr>
                                            <?php elseif($fila['IdCategoria'] == 2):?>
                                                <tr class="text-center">
                                                    <td><?php echo $fila['IdProducto'];?></td>
                                                    <td><?php echo $fila['Nombre'].'  '.$fila['Marca'].$fila['Descripcion'];?></td>
                                                    <td><?php echo 'Plomos';?></td>
                                                    <td><?php echo $fila['Stock'];?></td>
                                                    <td><?php echo 'S/ '. $fila['Precio'];?></td>
                                                    <td><span class="p-1 bg-danger m-2" style="font-size: 15px;">Desactivado</span></td>
                                                    <td><?php echo '<a href="modificarProducto.php?id='. $fila['IdProducto'] .'" class="btn btn-success"><i class="fas fa-edit"></i></a>'?>
                                                    <?php 
                                                        echo '<a href="activarEstado.php?id='.$fila['IdProducto'].'"  class="btn btn-primary"><i class="fas fa-check"></i></i></button>
                                                        </a>';
                                                        ?>  
                                                    </td>
                                                </tr>
                                            <?php elseif($fila['IdCategoria'] == 3):?>
                                                <tr class="text-center">
                                                    <td><?php echo $fila['IdProducto'];?></td>
                                                    <td><?php echo $fila['Nombre'].'  '.$fila['Marca'].$fila['Descripcion'];?></td>
                                                    <td><?php echo 'Aceites';?></td>
                                                    <td><?php echo $fila['Stock'];?></td>
                                                    <td><?php echo 'S/ '. $fila['Precio'];?></td>
                                                    <td><span class="p-1 bg-danger m-2" style="font-size: 15px;">Desactivado</span></td>
                                                    <td><?php echo '<a href="modificarProducto.php?id='. $fila['IdProducto'] .'" class="btn btn-success"><i class="fas fa-edit"></i></a>'?>
                                                    <?php 
                                                        echo '<a href="activarEstado.php?id='.$fila['IdProducto'].'"  class="btn btn-primary"><i class="fas fa-check"></i></i></button>
                                                        </a>';
                                                        ?>  
                                                    </td>
                                                </tr>
                                            <?php elseif($fila['IdCategoria'] == 4):?>
                                                <tr class="text-center">
                                                    <td><?php echo $fila['IdProducto'];?></td>
                                                    <td><?php echo $fila['Nombre'].'  '.$fila['Marca'].$fila['Descripcion'];?></td>
                                                    <td><?php echo 'Frenos';?></td>
                                                    <td><?php echo $fila['Stock'];?></td>
                                                    <td><?php echo 'S/ '. $fila['Precio'];?></td>
                                                    <td><span class="p-1 bg-danger m-2" style="font-size: 15px;">Desactivado</span></td>
                                                    <td><?php echo '<a href="modificarProducto.php?id='. $fila['IdProducto'] .'" class="btn btn-success"><i class="fas fa-edit"></i></a>'?>
                                                    <?php 
                                                        echo '<a href="activarEstado.php?id='.$fila['IdProducto'].'"  class="btn btn-primary"><i class="fas fa-check"></i></i></button>
                                                        </a>';
                                                        ?>  
                                                    </td>
                                                </tr>
                                            <?php else:?>
                                                <tr class="text-center">
                                                    <td><?php echo $fila['IdProducto'];?></td>
                                                    <td><?php echo $fila['Nombre'].'  '.$fila['Marca'].$fila['Descripcion'];?></td>
                                                    <td><?php echo 'Otros';?></td>
                                                    <td><?php echo $fila['Stock'];?></td>
                                                    <td><?php echo 'S/ '. $fila['Precio'];?></td>
                                                    <td><span class="p-1 bg-danger m-2" style="font-size: 15px;">Desactivado</span></td>
                                                    <td><?php echo '<a href="modificarProducto.php?id='. $fila['IdProducto'] .'" class="btn btn-success"><i class="fas fa-edit"></i></a>'?>
                                                    <?php 
                                                        echo '<a href="activarEstado.php?id='.$fila['IdProducto'].'"  class="btn btn-primary"><i class="fas fa-check"></i></i></button>
                                                        </a>';
                                                        ?>  
                                                    </td>
                                                </tr>
                                            <?php endif;?>

                                        <?php endif;?>                                     
                                    <?php $w++;
                                 endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<?php
require 'includes/templates/footer.php'; 
?>