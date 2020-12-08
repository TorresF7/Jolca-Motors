<div id="signupbox" class="main-form mx-auto d-flex flex-row flex-wrap bg-white my-4">
               
  <div class="col-lg-6  p-4"> 
    <!-- BUSCAR CLIENTE -->
    <p class="text-center" style="font-family: 'Noto Sans KR', sans-serif;font-size:18px;">Ya estoy registrado</p>
    <p class="text-center" style="font-family: 'Source Serif Pro', serif;">Ingresa tu DNI para continuar con el pedido</p>
    <label style="font-family: 'Rubik', sans-serif;color:#757575;" for="">DNI</label>    
    <form action="finalizar.php" method="post">
        <div class="input-group">
            <input class="form-control" type="text" maxlength="8" onkeypress="return isNumber(event)" pattern="[0-9]{8}" name="txtBuscarCliente" placeholder="Ingrese DNI" required>
        </div>
        <div class="mx-auto text-center mt-3">
            <button id="botonBuscar" style="padding: 10px 25px;" class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>  
  </div>  
                    
  <div class="info col-lg-6 p-4" style="border-left:solid 1px #e4e4e4;">
    <p class="text-center" style="font-family: 'Noto Sans KR', sans-serif;font-size:18px;">¿No estás registrado?</p>  
    <p class="text-center text-success" style="font-family: 'Roboto', sans-serif;font-size:16px;">Es necesario registrar sus datos para realizar el pedido</p>
    <form id="signupform" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
                            
        <div id="signupalert" style="display:none" class="alert alert-danger">
            <p>Error:</p>
            <span></span>  
        </div>
                            
        <div class="form-group">
            <label for="usuario" class="col-md-3 control-label" style="font-family: 'Rubik', sans-serif;color:#757575;">DNI</label>
            <div class="form-group">
                <input type="text" maxlength="8" pattern="[0-9]{8}" onkeypress="return isNumber(event)" class="form-control" name="DNI" placeholder="DNI" value="<?php if(isset($DNI)) echo $DNI; ?>" required>
                <i class="fa fa-address-card" aria-hidden="true"></i>
            </div>
        </div>

        <div class="form-group">
            <label for="nombre" class="col-md-3 control-label" style="font-family: 'Rubik', sans-serif;color:#757575;">Nombre:</label>
            <div class="form-group">
                <input type="text" class="form-control" onkeypress="return isNombre(event)" name="nombre" placeholder="Nombre" value="<?php if(isset($nombre)) echo $nombre; ?>" required >
                <i class="fa fa-user" aria-hidden="true"></i>
            </div>
        </div>                           
                            
        <div class="form-group">
            <label for="nombre" class="col-md-3 control-label"  style="font-family: 'Rubik', sans-serif;color:#757575;">Apellidos</label>
            <div class="form-group">
                <input type="text" class="form-control" onkeypress="return isNombre(event)" name="apellidos" placeholder="apellidos" value="<?php if(isset($apellidos)) echo $apellidos; ?>" required>
                <i class="fa fa-user" aria-hidden="true"></i>
            </div>
        </div>

        <div class="form-group">
            <label for="nombre" class="col-md-3 control-label" style="font-family: 'Rubik', sans-serif;color:#757575;">Dirección</label>
            <div class="form-group">
                <input type="text" class="form-control" name="direccion" placeholder="direccion" value="<?php if(isset($direccion)) echo $direccion; ?>" required>
                <i class="fa fa-address-book" aria-hidden="true"></i>
            </div>
        </div>

        <div class="form-group">
            <label for="nombre" class="col-md-3 control-label" style="font-family: 'Rubik', sans-serif;color:#757575;">Teléfono</label>
            <div class="form-group">
                <input type="tel" maxlength="9" pattern="[0-9]{9}" onkeypress="return isNumber(event)" class="form-control" name="telefono" placeholder="telefono" value="<?php if(isset($telefono)) echo $telefono; ?>" required>
                <i class="fa fa-phone" aria-hidden="true"></i>
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-md-3 control-label" style="font-family: 'Rubik', sans-serif;color:#757575;">Email</label>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email" value="<?php if(isset($email)) echo $email; ?>" required>
                <i class="fa fa-at" aria-hidden="true"></i>
            </div>
        </div>
                            
        <div class="mx-auto"> 
            <label for="captcha" class="col-md-3 control-label"></label>
            <div class="g-recaptcha" data-sitekey="6LfFGdUZAAAAAPtpEsb1p02BS6Ta94pR0R4azFJE"></div>
        </div> 
                            
        <div class="form-group text-center mt-3">                                      
            <button id="btn-signup" type="submit" style="padding: 10px 25px;" class="btn btn-primary">Registrar</button>   
        </div>
    </form>
    <?php echo resultBlock($errors); ?>

  </div>
        
</div>