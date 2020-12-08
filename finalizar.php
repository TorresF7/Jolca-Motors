<?php
session_start();
require 'includes/funciones/funciones.php';
require 'includes/templates/header-formulario.php'; 
require 'funcs/funcs.php';
require 'funcs/conexion.php';
require 'includes/templates/PostCliente.php'; 
?> 

 
<div class="container">

    <!-- <div class="p-4 mx-auto mt-4 bg-white d-flex flex-wrap justify-content-center col-lg-12">
        <img src="img/jolca.png" width="160" heigth="100">
    </div> -->


    <?php  
    if(isset($_SESSION['usuario']) == true && isset($_POST['txtBuscarCliente']) == false){
                $buscar_cliente = trim($_SESSION['usuario']);
                if(!empty($buscar_cliente)):    
                    require 'vendor/autoload.php';
                    $resultado = new Kawschool\Cliente;
                    $cliente = $resultado->buscarCliente($buscar_cliente);
                    foreach($cliente as $clienteP):
                        require 'includes/templates/datosCliente.php'; 

                    endforeach;
       
                endif;     
    }else if(isset($_POST['txtBuscarCliente']) == false){
        // REGISTRAR CLIENTE
        require 'includes/templates/RegistroCliente.php'; 

   } else if(isset($_POST['txtBuscarCliente']) == true){ 

            $buscar_cliente = trim($_POST['txtBuscarCliente']);
            if(!empty($buscar_cliente)){
                $resultado = buscarCliente($buscar_cliente);
                $cliente = $resultado->fetchAll();
                if($cliente==true){
                    foreach($cliente as $clienteP):
                        require 'includes/templates/FormularioCliente.php'; 
                    endforeach;
                }else if(isset($_SESSION['usuario'])==true){

                $buscar_cliente = trim($_SESSION['usuario']);
                        if(!empty($buscar_cliente)):    
                            require 'vendor/autoload.php';
                            $resultado = new Kawschool\Cliente;
                            $cliente = $resultado->buscarCliente($buscar_cliente);
                            foreach($cliente as $clienteP):
                            require 'includes/templates/FormularioCliente.php';  
                            endforeach;
                        endif;     
            } 
         
        }        
    }
    if(isset($_SESSION['usuario']) == false && isset($_POST['txtBuscarCliente']) == true){
            require 'includes/templates/RegistroCliente.php'; 
        
    }


    if(isset($_POST['txtBuscarCliente']) == true): 
    $buscar_cliente = trim($_POST['txtBuscarCliente']);
    $resultado = buscarCliente($buscar_cliente);
    $cliente = $resultado->fetchAll();
        if($cliente == false): ?>

            <script>
            Swal.fire({
                text: 'El cliente con DNI: <?php echo $buscar_cliente ?> no se encuentra registrado',
                type: "info",
                icon: "info"
            })
            </script>

    <?php endif;
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
    function isNombre(e) { // 1
        tecla = (document.all) ? e.keyCode : e.which; // 2
        if (tecla==8) return true; // 3
        patron =/[A-Za-zñÑáéíóú\s]/; // igual que el ejemplo, pero acepta también las letras ñ y Ñ // 4
        te = String.fromCharCode(tecla); // 5
        return patron.test(te); // 6
    }
</script>