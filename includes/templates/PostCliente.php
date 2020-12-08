<?php
$errors = array();
if(!empty($_POST)){
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

         $errors[]="Ya existe un cliente registrado con el DNI";
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