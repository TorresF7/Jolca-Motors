<div class="content-wrapper">
    <section class="content p-4">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 col-lg-6">
                <div class="card card-primary">
                    <div class="p-3">
                        <div class="p-3 bg-light text-center" style="font-size:18px;font-family: 'Roboto', sans-serif;font-weight:700;">Modificar
                            Producto<i class="fa fa-file-signature ml-2"></i></div>
                    </div>
                    <form method="POST" action="modificarProducto.php" enctype="multipart/form-data">
                        <input type="hidden" name="hCodigo" value="<?= $codigoProducto?>">

                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="Nombre">Nombre:</label>
                                    <input type="text" onkeypress="return isNombre(event)" maxlength="15" class="form-control" id="Nombre" name="Nombre"
                                        placeholder="Ingrese el nombre" value="<?= $Nombre?>">
                                </div>
                                <div class="col-lg-6">
                                    <label for="Marca">Marca:</label>
                                    <input type="text" onkeypress="return isNombre(event)" maxlength="15" class="form-control" id="Marca" name="Marca"
                                        placeholder="Ingrese la marca" value="<?= $Marca?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Descripcion">Descripción:</label>
                                <input type="text" onkeypress="return isNombre(event)" maxlength="25" class="form-control" id="Descripcion" name="Descripcion"
                                    placeholder="Ingrese la descripción" value="<?= $Descripcion?>">
                            </div>
                            <div class="form-group">
                                    <label for="nombre">Categoría</label>
                                    <?php
                                        $resultado = new Kawschool\Categoria;
                                        $categoria = $resultado->mostrarCategoria();
                                    ?>
                                    <select name="IdCategoria" class="form-control select2" id="Categoria">
                                        <?php foreach($categoria as $filaCat):?>
                                            <?php if($filaCat['Idcategoria'] == $IdCategoria):?>
                                                <option selected="selected" value="<?= $IdCategoria?>"><?php echo $filaCat['NombreCategoria']?></option>
                                            <?php else:?>
                                                <option value="<?= $filaCat['Idcategoria']?>"><?php echo $filaCat['NombreCategoria']?></option>
                                        <?php endif;?>
                                        <?php endforeach;?>
                                    </select>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="Stock">Cantidad:</label>
                                    <input type="text" maxlength="7" onkeypress="return isNumber(event)" min="1" class="form-control" id="Stock" name="Stock"
                                        placeholder="Ingrese la cantidad" value="<?= $Stock?>">
                                </div>
                                <div class="col-lg-6">
                                    <label for="Precio">Precio:</label>
                                    <input type="text" class="form-control" maxlength="10" onkeypress="return numericValidation(this,event)" id="Precio" name="Precio" onkeypress="return isDecimal(event)"
                                        placeholder="Ingrese el precio" value="<?=  $Precio?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Foto">Imágen Actual:</label>
                                <br>

                                <img src="data:image/jpg;base64,<?= base64_encode($Imagen) ; ?>" width="100"
                                    height="90">
                                <br><br>
                                <div class="form-group"> 
                                    <label for="Imagen">Añada la imágen del producto aquí :</label>
                                    <input type="file" class="form-control" id="Imagen" accept="image/png, image/jpeg, image/jpg" name="Imagen">
                                </div>

                            </div>

                        </div>


                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="crear-registro-invitado">Guardar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>