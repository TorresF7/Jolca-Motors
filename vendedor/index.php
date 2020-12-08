<?php
	session_start();
	require '../funcs/conexion.php';
	require '../funcs/funcs.php';
	$errors=array();
	
	if (isset($_POST['txtUsuario']) == true &&
	isset($_POST['txtClave']) == true) {

	if(!empty($_POST)){
	$usuario= $mysqli->real_escape_string($_POST['txtUsuario']);
	  $password= $mysqli->real_escape_string($_POST['txtUsuario']);
	  if(isNullLogin($usuario,$password)){
	  $nombre= $_POST['txtUsuario'];
	  $clave = $_POST['txtClave'];		
	  
	  }else{
		$_SESSION['usuario']=1;

		header('location:verificar.php');
	  }
	  $errors[]="Debe llenar todos los campos";
	  
	}
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Animated Login Form</title>
    <link rel="stylesheet" type="text/css" href="css2/style.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <img class="wave" src="img2/wave.png">
    <div class="container">
        <div class="img">

        </div>
        <div class="login-content">
            <form action="index.php" method="POST" >
                <img src="img2/avatar.svg">
                <h2 class="title">BIENVENIDO</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Usuario</h5>
                        <input type="text" name="txtUsuario" id="txtUsuario" class="input">
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Contraseña</h5>
                        <input type="password" class="input" name="txtClave" id="txtClave" >
                    </div>
                </div>

                <input type="submit" class="btn">
            </form>
			<?php echo resultBlock($errors); ?>
        </div>
    </div>
    <script type="text/javascript" src="js2/main.js"></script>
</body>

</html>