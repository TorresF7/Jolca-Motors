<?php

//Cantidad de lista en producto
function cantidadPeliculas(){

    $cantidad = 0;
    if(isset($_SESSION['cesto'])){
        foreach($_SESSION['cesto'] as $indice => $value){
           $cantidad++;
        }
    }

    return $cantidad;
}

function totalProductos(){

    $cantidad = 0;
    $k=0;
    if(isset($_SESSION['cesto'])){
        foreach($_SESSION['cesto'] as $indice => $value){
           $cantidad=$cantidad+$_SESSION['cestoCantidad'][$k];
            $k++;
        }
    }

    return $cantidad;
}
function ReagregarCarrito($pos,$cantidad,$sub,$stock){

if($stock>=($_SESSION['cestoCantidad'][$pos]+$cantidad)){


   	 $_SESSION['cestoCantidad'][$pos] = $_SESSION['cestoCantidad'][$pos]+$cantidad;
}
}



function actualizarCarrito($pos,$cantidad,$sub){


	$_SESSION['cestosSub'][$pos] = $sub;

   	 $_SESSION['cestoCantidad'][$pos] = $cantidad;
}


function buscarEnCarrito($id){
    $productos_cesto = $_SESSION['cesto'];
            $k=0; 
            $EU=-1;
               
            foreach( $productos_cesto as $buscar):
                    
                    if( $buscar==$id){
                        $EU=$k;
                       
                    }
                   $k++;
                       
                            
                        
                    endforeach; 
          return $EU;

}

function AgregarCarrito($productos_cesto,$id,$cantidad,$precio){
       
        $productos_cesto[] = $id;
        $_SESSION['cesto'] = $productos_cesto;

        if(isset($_SESSION['cestoCantidad']) == true){
           $Cantidad = $_SESSION['cestoCantidad']; 
        }else{
           $Cantidad = [];
        }
  
        $Cantidad[] = $cantidad;
        $_SESSION['cestoCantidad'] = $Cantidad;


        if(isset($_SESSION['cestosSub']) == true){
           $sub = $_SESSION['cestosSub']; 
        }else{
           $sub = [];
        }
    
        $sub[]= $precio;

        $_SESSION['cestosSub'] = $sub;
}

function calcularTotal(){

    $Suma=0;


      $y=0;  
        foreach($_SESSION['cestosSub'] as $total):
                
            $Suma=$Suma + ($total*$_SESSION['cestoCantidad'][$y]);
            $y++;
        endforeach; 

    
    return  $Suma;
}

function EliminarCarrito($arreglo,$pos){

        unset($arreglo[$pos]);

    return $arreglo;
}

?>