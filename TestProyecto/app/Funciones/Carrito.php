<?php

namespace App\Funciones;

class Carrito{


public function modificarArreglo($pos,$num,$arreglo = []){
		

   	 $arreglo[$pos] = $num;
		return $arreglo;
	}

//NUEVO
public function totalProductos(){
	$cantidad = 0;
	$k = 0;
	$arreglo = [3, 4, 2, 6];

	foreach ($arreglo as $pos => $value) {
		$cantidad = $cantidad + $arreglo[$k];
		$k++;
	}

	return $cantidad;
}

//NUEVO
public function reagregarCarrito($pos,$num,$arreglo = [], $stock){

	if ($stock >= $arreglo[$pos]+$num) {
		$arreglo[$pos] = $arreglo[$pos]+$num;
		return $arreglo;
	}

}


public function EliminarEArreglo($pos,$arregloc){


   unset($arregloc[$pos]);
  $arregloc= array_values($arregloc);

    return $arregloc;
}

public function calcularTotal(){

    $suma = 0;
    $arreglo1 = [3, 3, 3, 3];  //cestoSub
    $arreglo2 = [2, 2, 2, 2];  //cestoCantidad
    $i = 0;
    foreach ($arreglo1 as $pos => $valor) {
    	$suma = $suma + ($valor * $arreglo2[$i]);
    	$i++;
    }

    return $suma;
}

public function buscarEnCarrito($id){
	$arreglo = [1, 2, 3, 4, 5, 6, 7, 8];
	$k = 0;
	$EU = -1;

	foreach ($arreglo as $buscar){
		if ($buscar == $id) {
			$EU=$k;
		}
		$k++;
	}
	return $EU; 
}

//NUEVO
public function cantidadProductos(){
	$cantidad = 0;

	$arreglo = [5, 9, 8, 3, 6];

	foreach ($arreglo as $pos => $value) {
		$cantidad++;
	}

	return $cantidad;
}

public function agregarCarrito($var = [], $id){
	$var[] = $id;
	$arreglo1 = $var;

	
	return $arreglo1;
}

}

