<div class="main-form  mx-auto rounded mb-3 d-flex flex-row flex-wrap bg-white my-4">    
    <div class="col-lg-6 p-4">
         <!-- BUSCAR CLIENTE -->
         <p class="text-center" style="font-family: 'Noto Sans KR', sans-serif;font-size:18px;">Ya estoy registrado</p>
         <p class="text-center" style="font-family: 'Source Serif Pro', serif;">Ingresa tu DNI para continuar con el pedido</p>
         <label style="font-family: 'Rubik', sans-serif;color:#757575;" for="">DNI</label>   
         <?php if(isset($_POST['txtBuscarCliente']) == true){?> 
         <form action="finalizar.php" method="post">
             <div class="input-group">
                 <input class="form-control" type="text" maxlength="8" onkeypress="return isNumber(event)" pattern="[0-9]{8}" name="txtBuscarCliente" value="<?php echo $_POST['txtBuscarCliente'];?>">
             </div> 
             <div class="mx-auto text-center mt-3">
                 <button id="botonBuscar" style="padding: 10px 25px;" class="btn btn-primary" type="submit">Buscar</button>
             </div>
         </form>    
         <?php }else if(isset($_POST['txtBuscarCliente']) == false){?>
             <form action="finalizar.php" method="post">
             <div class="input-group">
                 <input class="form-control" type="text" maxlength="8" onkeypress="return isNumber(event)" pattern="[0-9]{8}" name="txtBuscarCliente" placeholder="Ingrese DNI" required>
             </div>
             <div class="mx-auto text-center mt-3">
                 <button id="botonBuscar" style="padding: 10px 25px;" class="btn btn-primary" type="submit">Ingresar</button>
             </div>
         </form> 
         <?php }?>     
    </div>
    <?php $_SESSION['usuario'] = $clienteP['Dni'];?>
    <div class="info col-lg-6 p-4" style="border-left:solid 1px #e4e4e4;">
        <p class="text-center" style="font-family: 'Noto Sans KR', sans-serif;font-size:18px;">Datos del cliente</p> 
        <p class="text-center text-success" style="font-family: 'Roboto', sans-serif;font-size:16px;">Datos cargados exitosamente ¡Ahora envía tu pedido!</p>
        <form action="comprar2.php" method="post" id="form-envio-pedido">
            <label class="col-form-label" style="font-family: 'Rubik', sans-serif;color:#757575;">DNI</label>
            <div class="form-group">
                <input  type="text" class="form-control" name="txtCdni" value="<?php echo $clienteP['Dni']?>" disabled>
                <i class="fa fa-address-card" aria-hidden="true"></i>
            </div>
            <label class="col-form-label" style="font-family: 'Rubik', sans-serif;color:#757575;">Nombre</label>
            <div class="form-group">
                <input  type="text" class="form-control" name="txtnombre" value="<?php echo $clienteP['Nombres']?>" disabled> 
                <i class="fa fa-user" aria-hidden="true"></i>
            </div>
            <label class="col-form-label" style="font-family: 'Rubik', sans-serif;color:#757575;">Apellidos</label>
            <div class="form-group">
                <input  type="text" class="form-control" name="txtapellidos" value="<?php echo $clienteP['Apellidos'];?>" disabled>
                <i class="fa fa-user" aria-hidden="true"></i>
            </div>
            <label class="col-form-label" style="font-family: 'Rubik', sans-serif;color:#757575;">Dirección</label>
            <div class="form-group">
                <input  type="text" class="form-control" name="txtdireccion" value="<?php echo $clienteP['Direccion']?>" disabled> 
                <i class="fa fa-address-book" aria-hidden="true"></i>
            </div>
            <label class="col-form-label" style="font-family: 'Rubik', sans-serif;color:#757575;">Teléfono</label>
            <div class="form-group">
                <input  type="text" class="form-control" name="txttelefono"  value="<?php echo $clienteP['Telefono']?>" disabled>
                <i class="fa fa-phone" aria-hidden="true"></i>
            </div>
            <label class="col-form-label" style="font-family: 'Rubik', sans-serif;color:#757575;">Correo</label>
            <div class="form-group">
                <input type="email" class="form-control form-control-sm" name="txtcorreo" value="<?php echo $clienteP['correo']?>" disabled>
                <i class="fa fa-at" aria-hidden="true"></i>
            </div>
                <div class="form-group text-center mt-3">
                        <button type="button"  onclick="VerificarEnvioPedido()" style="padding: 10px 25px;" class="btn btn-primary">Enviar</button>
                </div>
        </form>
    </div>
</div>  