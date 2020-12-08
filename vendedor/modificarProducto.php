<?php 
    require 'includes/funciones/funciones.php';
    require 'includes/templates/header.php'; 
    require 'includes/templates/barra.php'; 
    require 'includes/templates/navegacion.php'; 
    require '../vendor/autoload.php';
?>
<?php
    // Definiendo variables
    $Nombre = '';
    $Marca = '';
    $Descripcion = '';
    $Stock = '';
    $Precio = '';
    $IdCategoria = 0;
    $Imagen = '';
    $IdPedido = '';
    $IdProducto = 0;
    $productos = '';

if(isset($_GET['id']) == true){
    $codigoProducto = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    
    
    // Mostrar Datos
    $resultado = new Kawschool\Producto;
    $productos = $resultado->mostrarPorId($codigoProducto);
    $IdCategoria=$productos[0]['IdCategoria'];
    $Nombre=$productos[0]['Nombre'];
    $Marca=$productos[0]['Marca'];
    $Descripcion=$productos[0]['Descripcion'];
    $Stock=$productos[0]['Stock'];
    $Precio=$productos[0]['Precio'];
    $Imagen=$productos[0]['Imagen'];
    require 'includes/templates/modificar.php'; 
}else{
    // Modificar Datos 
    if(isset($_POST['Nombre'])==true &&
        isset($_POST['Marca'])==true &&
        isset($_POST['Descripcion'])==true &&
        isset($_POST['Stock'])==true &&
        isset($_POST['Precio'])==true &&
        isset($_POST['IdCategoria'])==true ){
            $codigo =(int) $_POST['hCodigo'];
            $Nombre=trim($_POST['Nombre']);
            $Marca=trim($_POST['Marca']);
            $Descripcion=$_POST['Descripcion'];
            $Stock=(int)$_POST['Stock'];
            $Precio=(float)$_POST['Precio'];
            $IdCategoria=(int)$_POST['IdCategoria'];
        $productoBuscar = new Kawschool\Producto;    
        $igual=$productoBuscar->NombreExisteAc($Nombre,$Marca,$Descripcion,$codigo);
        if($igual==false){    
            
            if($_FILES['Imagen']['error']==UPLOAD_ERR_OK){
                $check = getimagesize($_FILES['Imagen']['tmp_name']);
                if($check !== false) {
                    $Imagen=  addslashes(file_get_contents($_FILES['Imagen']['tmp_name']));
                    $producto = new Kawschool\Producto;
                    $retorno= $producto->actualizarProducto($codigo,$IdCategoria,$Nombre,$Marca,$Descripcion,$Stock,$Precio,$Imagen);
                    }

            }else{
                $producto = new Kawschool\Producto;
                $retorno= $producto->actualizarProductoSI($codigo,$IdCategoria,$Nombre,$Marca,$Descripcion,$Stock,$Precio);                 
            }
            echo'<meta http-equiv="refresh" content="0;url=listadoProductos.php">'; 
        }else{
            ?>
            <script src="../js/sweetalert2.all.min.js"></script>
   
         <script>
         Swal.fire({
           text: 'Producto ingresado ya existe',
           type: "error",
         }).then(function() {
            window.location = <?php  echo'"modificarProducto.php?id='. $codigo.'"' ?> ;
             });
             
       </script>
           <?php 
              
        }
        }
       
}
?>
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
        patron =/[A-Za-zñÑáéíóú0123456789\s]/; // igual que el ejemplo, pero acepta también las letras ñ y Ñ // 4
        te = String.fromCharCode(tecla); // 5
        return patron.test(te); // 6
    }

    function isDecimal(obj,evt) {
        evt = (evt) ? evt : window.event;
        // var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (evt.keyCode > 47 && evt.keyCode < 58 || evt.keyCode == 46) {
          
            if (obj.value.indexOf(".") > -1){ 
                return false; 
                  
            }
        }
        else {
                
                var idx = doGetCaretPosition(obj); 
                var part1 = obj.value.substr(0,idx), 
                part2 = obj.value.substring(idx); 

                if (part2.length > 2) { 
                    obj.value = part1 + "." + part2.substr(0,2); 
                    setCaretPosition(obj, idx + 1); 
                    return false;
                }   
            }  

    }

    function numericValidation(obj,evt) { 
     var e = event || evt; // for trans-browser compatibility 

     var charCode = e.which || e.keyCode;   

     if (charCode == 46) { //one dot 
      if (obj.value.indexOf(".") > -1) 
       return false; 
      else { 
       //---if the dot is positioned in the middle give the user a surprise, remember: just 2 decimals allowed 
       var idx = doGetCaretPosition(obj); 
       var part1 = obj.value.substr(0,idx), 
        part2 = obj.value.substring(idx); 

       if (part2.length > 2) { 
        obj.value = part1 + "." + part2.substr(0,2); 
        setCaretPosition(obj, idx + 1); 
        return false; 
       }//--- 

       //allow one dot if not cheating 
       return true; 
      } 
     } 
     else if (charCode > 31 && (charCode < 48 || charCode > 57)) { //just numbers 
      return false; 
     } 

     //---just 2 decimals stubborn! 
     var arr = obj.value.split(".") , pos = doGetCaretPosition(obj); 

     if (arr.length == 2 && pos > arr[0].length && arr[1].length == 2)        
      return false; 
     //--- 

     //ok it's a number 
     return true; 
    } 

    function doGetCaretPosition (ctrl) { 
     var CaretPos = 0; // IE Support 
     if (document.selection) { 
     ctrl.focus(); 
      var Sel = document.selection.createRange(); 
      Sel.moveStart ('character', -ctrl.value.length); 
      CaretPos = Sel.text.length; 
     } 
     // Firefox support 
     else if (ctrl.selectionStart || ctrl.selectionStart == '0') 
      CaretPos = ctrl.selectionStart; 
     return (CaretPos); 
    } 

    function setCaretPosition(ctrl, pos){ 
     if(ctrl.setSelectionRange) 
     { 
      ctrl.focus(); 
      ctrl.setSelectionRange(pos,pos); 
     } 
     else if (ctrl.createTextRange) { 
      var range = ctrl.createTextRange(); 
      range.collapse(true); 
      range.moveEnd('character', pos); 
      range.moveStart('character', pos); 
      range.select(); 
     } 
    }
    
</script>
<?php
require 'includes/templates/footer.php'; 
?>