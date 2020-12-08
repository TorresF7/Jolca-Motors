<tbody>
                     <?php foreach($pedidos as $pedido):?>
                    <tr>
                            <td><?php echo $pedido['IdProducto'];?></td>  
                            <td><?php echo $pedido['Dni'];?></td>
                            <td><?php echo $pedido['Stock'];?></td>
                            <td><?php echo $pedido['Cantidad']?></td>
                             <td><?php echo $pedido['Subtotal']?></td>
                      <!-- <td class="text-danger">No se puede realizar venta</td> -->
                      <td>
                        <?php 
                          echo '<div class="d-flex">
                                  <div><a href="modificarDetalle.php?id='.$codigo.'&det='.$pedido['IdProducto'].'" class="btn btn-success m-2"><i class="fas fa-edit"></i></a></div>
                                  <form action="EliminarDetalle.php?id='.$codigo.'&det='.$pedido['IdProducto'].'"  method="post" id="form-eliminarDetalle" style="padding:0!important;">
                                    <button type="button" class="btn btn-danger m-2" onclick="ConfirmarEliminacionDetalle()"><i class="fa fa-trash-alt"></i></button>
                                  </form>
                                </div>';
                        ?>
                      </td>
                    </tr>
                   <?php  endforeach;?>
                  </tbody>