<?php
session_start();
require 'includes/funciones/funciones.php';
require 'includes/templates/header-formulario.php'; 
require 'funcs/funcs.php';
require 'funcs/conexion.php';
$errors = array();
 if(!empty($_POST))
 {
if(isset($_POST['nombre'])==true){
 $nombre= $mysqli->real_escape_string($_POST['nombre']);
 $apellidos= $mysqli->real_escape_string($_POST['apellidos']);
 $direccion= $mysqli->real_escape_string($_POST['direccion']);
 $telefono= $mysqli->real_escape_string($_POST['telefono']);
 $DNI= $mysqli->real_escape_string($_POST['DNI']);
 $email= $mysqli->real_escape_string($_POST['email']);
 $captcha= $mysqli->real_escape_string($_POST['g-recaptcha-response']);

 $activo=1;
 $tipo_usuario=2;
 $secret= '6LfFGdUZAAAAACqbP6D-g6sXYYOtjEh5d3RwBedK';


 
 if(!$captcha){
    $errors[]="Por verifica el captcha";
 }

 if(isNull($nombre,$DNI,$email)){

    $errors[]="debe llenar todos los campos";
 }

if(!isEmail($email)){

    $errors[]="Dirección de correo inválido";
 }


 if(DNIExiste($DNI)){

    $errors[]="El usuario ya existe";
 }

 if(emailExiste($email)){

    $errors[]="El correo ya existe";
 }

 if(count($errors)==0){

    $response= file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");

    $arr=json_decode($response,TRUE);
    if($arr['success']){

 

        $registro= registraCliente($DNI, $nombre, $apellidos, $email, $direccion, $telefono);
        
        if($registro>0){
             $_SESSION['usuario'] = $DNI;

            }else{

            }

        }else{
        $errors[]="Error al registrar ";    
        }

    }else{
            $errors[]="Error al registrar captcha";

    }
 }
}
 

?>


<div class="container">
 
        <div class="p-4 mx-auto mt-4 bg-white d-flex flex-wrap justify-content-center col-lg-12">
            <img src="img/jolca.png" width="160" heigth="100">
        </div>

 
        <?php  
            if(isset($_SESSION['usuario']) == true && isset($_POST['txtBuscarCliente']) == false){
                $buscar_cliente = $_SESSION['usuario'];
                if(!empty($buscar_cliente)):    
                    require 'vendor/autoload.php';
                    $resultado = new Kawschool\Cliente;
                    $cliente = $resultado->buscarCliente($buscar_cliente);
                    foreach($cliente as $clienteP):?> 
                        
                        <div class="main-form bg-white mb-3 d-flex flex-row flex-wrap">  

                            <div class="col-lg-6 p-4">
                                <!-- BUSCAR CLIENTE -->
                                <p class="text-center" style="font-family: 'Noto Sans KR', sans-serif;font-size:18px;">Ya estoy registrado</p>
                                <p class="text-center" style="font-family: 'Source Serif Pro', serif;">Iniciar sesión para continuar con la compra</p>
                                <label style="font-family: 'Rubik', sans-serif;color:#757575;" for="">DNI</label>   
                                <?php if(isset($_POST['txtBuscarCliente']) == true){?> 
                                <form action="finalizar.php" method="post">
                                    <div class="input-group">
                                        <input class="form-control" type="text" maxlength="8" onkeypress="return isNumber(event)" pattern="[0-9]{8}" name="txtBuscarCliente" value="<?php echo $_POST['txtBuscarCliente'];?>">
                                    </div>
                                    <div class="mx-auto text-center mt-3">
                                        <button id="botonBuscar" style="padding: 10px 25px;" class="btn btn-primary" type="submit">Ingresar</button>
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
                                <span class="text-center" id="MSJ"></span>              
                            </div>

                            <div class="info col-lg-6" style="border-left:solid 1px #e4e4e4;">
                            <p class="text-center p-3" style="font-family: 'Noto Sans KR', sans-serif;font-size:18px;">Datos del cliente</p> 
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
                                        <input  type="text" class="form-control" name="txtcorreo"  value="<?php echo $clienteP['correo']?>" disabled>
                                        <i class="fa fa-at" aria-hidden="true"></i>
                                    </div>

                                    <div class="form-group text-center mt-3">
                                        <button type="button"   onclick="VerificarEnvioPedido()" style="padding: 10px 25px;" class="btn btn-primary">Enviar</button>
                                    </div>
                                    
                                </form>  
                            </div>
                        </div>              
                        
              <?php endforeach;
       
                endif;     
            }else if(isset($_POST['txtBuscarCliente']) == false){ ?> 
              
              <!-- FORMULARIO POR DEFECTO -->
            <div id="signupbox" class="main-form mx-auto d-flex flex-row flex-wrap bg-white mb-4">
               
                    <div class="col-lg-6  p-4">
                        <!-- BUSCAR CLIENTE -->
                        <p class="text-center" style="font-family: 'Noto Sans KR', sans-serif;font-size:18px;">Ya estoy registrado</p>
                        <p class="text-center" style="font-family: 'Source Serif Pro', serif;">Iniciar sesión para continuar con la compra</p>
                        <label style="font-family: 'Rubik', sans-serif;color:#757575;" for="">DNI</label>    
                        <form action="finalizar.php" method="post">
                            <div class="input-group">
                                <input class="form-control" type="text" maxlength="8" onkeypress="return isNumber(event)" pattern="[0-9]{8}" name="txtBuscarCliente" placeholder="Ingrese DNI" required>
                            </div>
                            <div class="mx-auto text-center mt-3">
                                <button id="botonBuscar" style="padding: 10px 25px;" class="btn btn-primary" type="submit">Ingresar</button>
                            </div>
                        </form>  
                    </div>  
                    
                    <div class="info col-lg-6 p-4" style="border-left:solid 1px #e4e4e4;">
                        <p class="text-center" style="font-family: 'Noto Sans KR', sans-serif;font-size:18px;">¿No estás registrado?</p>  
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
                                    <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php if(isset($nombre)) echo $nombre; ?>" required >
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>
                            </div>                           
                            
                            <div class="form-group">
                                <label for="nombre" class="col-md-3 control-label" style="font-family: 'Rubik', sans-serif;color:#757575;">Apellidos</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="apellidos" placeholder="apellidos" value="<?php if(isset($apellidos)) echo $apellidos; ?>" required>
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
     
    <?php  }

       else if(isset($_POST['txtBuscarCliente']) == true){

            $buscar_cliente = $_POST['txtBuscarCliente'];
            if(!empty($buscar_cliente)){
                $resultado = buscarCliente($buscar_cliente);
                $cliente = $resultado->fetchAll();
           if($cliente==true){

              foreach($cliente as $clienteP):?> 
                <!--Formulario para la busqueda-->   
              <div class="main-form  mx-auto rounded mb-3 d-flex flex-row flex-wrap bg-white">    
                <div class="col-lg-6 p-4">
                    <!-- BUSCAR CLIENTE -->
                    <p class="text-center" style="font-family: 'Noto Sans KR', sans-serif;font-size:18px;">Ya estoy registrado</p>
                    <p class="text-center" style="font-family: 'Source Serif Pro', serif;">Iniciar sesión para continuar con la compra</p>
                    <label style="font-family: 'Rubik', sans-serif;color:#757575;" for="">DNI</label>   
                    <?php if(isset($_POST['txtBuscarCliente']) == true){?> 
                    <form action="finalizar.php" method="post">
                        <div class="input-group">
                            <input class="form-control" type="text" maxlength="8" onkeypress="return isNumber(event)" pattern="[0-9]{8}" name="txtBuscarCliente" value="<?php echo $_POST['txtBuscarCliente'];?>">
                        </div>
                        <div class="mx-auto text-center mt-3">
                            <button id="botonBuscar" style="padding: 10px 25px;" class="btn btn-primary" type="submit">Ingresar</button>
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
        <?php endforeach;
    }else if(isset($_SESSION['usuario'])==true){

        $buscar_cliente = $_SESSION['usuario'];
                if(!empty($buscar_cliente)):    
                    require 'vendor/autoload.php';
                    $resultado = new Kawschool\Cliente;
                    $cliente = $resultado->buscarCliente($buscar_cliente);
                    foreach($cliente as $clienteP):?> 
                        
                        <div class="main-form mb-3 d-flex flex-row flex-wrap bg-white">     
                            <div class="col-lg-6 p-4">
                                <!-- BUSCAR CLIENTE -->
                                <p class="text-center" style="font-family: 'Noto Sans KR', sans-serif;font-size:18px;">Ya estoy registrado</p>
                                <p class="text-center" style="font-family: 'Source Serif Pro', serif;">Iniciar sesión para continuar con la compra</p>
                                <label style="font-family: 'Rubik', sans-serif;color:#757575;" for="">DNI</label>   
                                <?php if(isset($_POST['txtBuscarCliente']) == true){?> 
                                <form action="finalizar.php" method="post">
                                    <div class="input-group">
                                        <input class="form-control" type="text" maxlength="8" onkeypress="return isNumber(event)" pattern="[0-9]{8}" name="txtBuscarCliente" value="<?php echo $_POST['txtBuscarCliente'];?>">
                                    </div>
                                    <div class="mx-auto text-center mt-3">
                                        <button id="botonBuscar" style="padding: 10px 25px;" class="btn btn-primary" type="submit">Ingresar</button>
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
                            
                            <div class="info col-lg-6" style="border-left:solid 1px #e4e4e4;">
                            <p class="text-center p-3" style="font-family: 'Noto Sans KR', sans-serif;font-size:18px;">Datos del cliente</p> 
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
                                        <input  type="text" class="form-control" name="txtcorreo"  value="<?php echo $clienteP['correo']?>" disabled>
                                        <i class="fa fa-at" aria-hidden="true"></i>
                                    </div>

                        

                                    <div class="d-flex justify-content-sm-center justify-content-lg-end">
                                        <button type="button"  onclick="VerificarEnvioPedido()" style="font-size:18px;font-family:Roboto;" class="btn btn-primary p-2 btn-block">Enviar</button>
                                    </div>
                                    
                                </form>  
                            </div>
                        </div>              
                        
              <?php endforeach;
       
                endif;     
       

    }
  
             ?>
               
      <?php }       
        }
        if(isset($_SESSION['usuario']) == false && isset($_POST['txtBuscarCliente']) == true){
         ?> 
           <div id="signupbox" class="main-form mx-auto d-flex flex-row flex-wrap bg-white mb-4">
                   
                    <div class="col-lg-6 p-4">
                         <!-- BUSCAR CLIENTE -->
                        <p class="text-center" style="font-family: 'Noto Sans KR', sans-serif;font-size:18px;">Ya estoy registrado</p>
                        <p class="text-center" style="font-family: 'Source Serif Pro', serif;">Iniciar sesión para continuar con la compra</p>
                        <label style="font-family: 'Rubik', sans-serif;color:#757575;" for="">DNI</label>    
                        <form action="finalizar.php" method="post">
                            <div class="input-group">
                                <input class="form-control" type="text" maxlength="8" onkeypress="return isNumber(event)" pattern="[0-9]{8}" name="txtBuscarCliente" placeholder="Ingrese DNI" required>
                            </div>
                            <div class="mx-auto text-center mt-3">
                                <button id="botonBuscar" style="padding: 10px 25px;" class="btn btn-primary" type="submit">Ingresar</button>
                            </div>
                        </form>    
                    </div>  
                    
                    <div class="info col-lg-6" style="border-left:solid 1px #e4e4e4;">
                        <p class="text-center p-3" style="font-family: 'Noto Sans KR', sans-serif;font-size:18px;">Registro del cliente</p> 
                        <form id="signupform" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
                            
                            <div id="signupalert" style="display:none" class="alert alert-danger">
                                <p>Error:</p>
                                <span></span>
                            </div>
                           
                            
                            <label for="usuario" class="col-md-3 control-label" style="font-family: 'Rubik', sans-serif;color:#757575;">DNI</label>
                                <div class="form-group">
                                    <input type="text" maxlength="8" onkeypress="return isNumber(event)" pattern="[0-9]{8}" class="form-control" name="DNI" placeholder="DNI" value="<?php if(isset($DNI)) echo $DNI; ?>" required>
                                    <i class="fa fa-address-card" aria-hidden="true"></i>
                                </div>
 
                            <label for="nombre" class="col-md-3 control-label" style="font-family: 'Rubik', sans-serif;color:#757575;">Nombre:</label>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm" name="nombre" placeholder="Nombre" value="<?php if(isset($nombre)) echo $nombre; ?>" required >
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </div>  
                            
                            <label for="nombre" class="col-md-3 control-label" style="font-family: 'Rubik', sans-serif;color:#757575;">Apellidos</label>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm" name="apellidos" placeholder="apellidos" value="<?php if(isset($apellidos)) echo $apellidos; ?>" required>
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </div>

                        
                            <label for="nombre" class="col-md-3 control-label" style="font-family: 'Rubik', sans-serif;color:#757575;">Dirección</label>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm" name="direccion" placeholder="direccion" value="<?php if(isset($direccion)) echo $direccion; ?>" required>
                                <i class="fa fa-address-book" aria-hidden="true"></i>
                            </div>
        
        
                            <div class="form-group">
                                <label for="nombre" class="col-md-3 control-label" style="font-family: 'Rubik', sans-serif;color:#757575;">Teléfono</label>
                                <div class="form-group">
                                    <input type="tel" maxlength="9" pattern="[0-9]{9}" onkeypress="return isNumber(event)"  class="form-control" name="telefono" placeholder="telefono" value="<?php if(isset($telefono)) echo $telefono; ?>" required>
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </div>
                            </div>
                            
                            <label for="email" class="col-md-3 control-label" style="font-family: 'Rubik', sans-serif;color:#757575;">Email</label>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-sm" name="email" placeholder="Email" value="<?php if(isset($email)) echo $email; ?>" required>
                                <i class="fa fa-at" aria-hidden="true"></i>
                            </div>

                            
                            <div class="form-group">
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
         <?php
    }


        ?>    
    <?php if(isset($_POST['txtBuscarCliente']) == true): 
    $buscar_cliente = $_POST['txtBuscarCliente'];
    $resultado = buscarCliente($buscar_cliente);
    $cliente = $resultado->fetchAll();
        if($cliente == false): 
            ?>

        <script>
Swal.fire({
      text: 'El cliente con DNI: <?php echo $buscar_cliente ?> no se encuentra registrado',
      type: "info",
      icon:"info"
    })
</script>


<?php 
endif;
endif;?>
</div>

<?php require 'includes/templates/footer.php';?>

<script type="text/javascript">
    
    function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>



