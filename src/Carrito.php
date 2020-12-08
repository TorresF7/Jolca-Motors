<?php

namespace Kawschool;

class Carrito{


/**
 * modificarArreglo
 *
 * @param  mixed $pos
 * @param  mixed $num
 * @param  mixed $arreglo
 * @return void
 */
public function modificarArreglo($pos,$num,$arreglo = []){
		

   	 $arreglo[$pos] = $num;
		return $arreglo;
	}

//NUEVO
/**
 * totalProductos
 *
 * @return void
 */
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
/**
 * reagregarCarrito
 *
 * @param  mixed $pos
 * @param  mixed $num
 * @param  mixed $arreglo
 * @param  mixed $stock
 * @return void
 */
public function reagregarCarrito($pos,$num,$arreglo = [], $stock){

	if ($stock >= $arreglo[$pos]+$num) {
		$arreglo[$pos] = $arreglo[$pos]+$num;
		return $arreglo;
	}

}


/**
 * EliminarEArreglo
 *
 * @param  mixed $pos
 * @param  mixed $arregloc
 * @return void
 */
public function EliminarEArreglo($pos,$arregloc){


   unset($arregloc[$pos]);
  $arregloc= array_values($arregloc);

    return $arregloc;
}

/**
 * calcularTotal
 *
 * @return void
 */
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

/**
 * buscarEnCarrito
 *
 * @param  mixed $id
 * @return void
 */
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
/**
 * cantidadProductos
 *
 * @return void
 */
public function cantidadProductos(){
	$cantidad = 0;

	$arreglo = [5, 9, 8, 3, 6];

	foreach ($arreglo as $pos => $value) {
		$cantidad++;
	}

	return $cantidad;
}

/**
 * agregarCarrito
 *
 * @param  mixed $var
 * @param  mixed $id
 * @return void
 */
public function agregarCarrito($var = [], $id){
	$var[] = $id;
	$arreglo1 = $var;

	
	return $arreglo1;
}

}

