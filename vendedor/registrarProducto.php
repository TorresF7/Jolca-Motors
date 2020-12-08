<?php 
    require 'includes/funciones/funciones.php';
    require 'includes/templates/header.php'; 
    require 'includes/templates/barra.php'; 
    require 'includes/templates/navegacion.php'; 

    require '../vendor/autoload.php';
    $Imagen = '';
    if(isset($_POST['Nombre'])==true &&
    isset($_POST['Marca'])==true &&
    isset($_POST['Descripcion'])==true &&
    isset($_POST['Stock'])==true &&
    isset($_POST['Precio'])==true &&
 
    isset($_POST['IdCategoria'])==true ){

    
    $producto = new Kawschool\Producto;
    
    
    $IdCategoria=$_POST['IdCategoria'];
    $Nombre=trim($_POST['Nombre']);
    $Marca=trim($_POST['Marca']);
    $Descripcion=$_POST['Descripcion'];
    $Stock=trim($_POST['Stock']);
    $Precio=trim($_POST['Precio']);
    $Imagen= $_FILES['Imagen']['tmp_name'];
    $igual=$producto->NombreExiste($Nombre,$Marca,$Descripcion);
    if($igual==false){

    
     $_params = array(    
      'Nombre' => $Nombre,
      'Marca' => $Marca,
      'Descripcion' => $Descripcion,
      'Stock' => $Stock,
      'Precio' => $Precio,
      'Imagen' => $Imagen, 
      'IdCategoria' => $IdCategoria,
     );
  $productor = new Kawschool\Producto;
  $productor->registrar($_params);
 echo'<meta http-equiv="refresh" content="0;url=listadoProductos.php">'; 
}else{

    ?>
           <script src="../js/sweetalert2.all.min.js"></script>
  
        <script>
        Swal.fire({
          text: 'Producto ingresado ya existe',
          type: "error",
        }).then(function() {
                
            });

      </script>
          <?php 
}
 
}

?>
<script src="../js/mensajes.js"></script>
<div class="content-wrapper">
    <section class="content p-4">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 col-lg-6">    
                <div class="card card-primary">
                    <div class="p-3">
                        <div class="p-3 bg-light text-center" style="font-size:18px;font-family: 'Roboto', sans-serif;font-weight:700;">Registrar Producto<i class="fa fa-file-signature ml-2"></i></div>
                    </div>
                    <form method="POST" action="registrarProducto.php"  enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="Nombre">Nombre:</label>
                                    <input type="text" class="form-control" onkeypress="return isNombre(event)" maxlength="15" id="Nombre" name="Nombre"  placeholder="Ingrese el nombre" required>
                                </div> 
                                <div class="col-lg-6">
                                    <label for="Marca">Marca:</label>
                                    <input type="text" class="form-control" onkeypress="return isNombre(event)" maxlength="15" id="Marca" name="Marca" placeholder="Ingrese la marca" required>
                                </div> 
                            </div>
                            
                            <div class="form-group">
                                <label for="Descripcion">Descripción:</label>
                                <input type="text" class="form-control" onkeypress="return isNombre(event)" maxlength="25" id="Descripcion" name="Descripcion" placeholder="Ingrese la descripción" required>
                            </div> 
                            <div class="form-group">
                                <label for="IdCategoria">Categoría</label>
                                <select name="IdCategoria" class="form-control select2" id="IdCategoria" required>
                                    <option value="">-- Seleccione --</option>
                                    <option value="1">Neumáticos</option>
                                    <option value="2">Plomos</option>
                                    <option value="3">Aceite y Refrigerante</option>
                                    <option value="4">Frenos</option>
                                    <option value="5">Otros</option>
                                    
                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="Stock">Cantidad:</label>
                                    <input type="text" maxlength="7" onkeypress="return isNumber(event)" min="1" class="form-control" id="Stock" name="Stock" placeholder="Ingrese la cantidad" required>
                                </div>
                                <div class="col-lg-6">
                                    <label for="Precio">Precio:</label>
                                    <input type="text"  min="1" onkeypress="return numericValidation(this,event)" maxlength="10" class="form-control" id="Precio" name="Precio" placeholder="Ingrese el precio" required>
                                </div>
                            </div>  
                            <div class="form-group">
                                <label for="Imagen">Foto :</label>
                                <input type="file" class="form-control" id="Imagen" accept="image/png, image/jpeg, image/jpg" required name="Imagen"/>
                            </div>
                        </div>
                        <div class="card-footer ">
                            
                            <button type="submit" class="btn btn-primary" id="crear-registro-invitado" >Registrar</button>
                        </div>

                        
                    </form>
                </div>
            </div>
        </div>
    </section> 
</div>
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