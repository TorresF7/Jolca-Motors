<?php

use App\Funciones\Carrito;

class CarritoTest extends \PHPUnit_Framework_TestCase{
	/** @test **/
	public function Probar_que_se_puede_modificar_carrito() {
		$carrito = new Carrito;

	$arregloM=[8, 3, 7, 3];


	$resultado2 = $carrito->modificarArreglo(1,3,[8, 2, 7, 3]);


	$this->assertEquals($arregloM, $resultado2);

}

//NUEVO
/** @test **/
	public function Probar_que_se_puede_reagregar_carrito() {
		$carrito = new Carrito;

	$arregloM=[5, 11, 7, 8];


	$resultado2 = $carrito->reagregarCarrito(1, 5, [5, 6, 7, 8], 20);


	$this->assertEquals($arregloM, $resultado2);

}

/** @test **/
public function Probar_que_se_pueda_eliminar_carrito() {
		$carrito = new Carrito;
		$arregloc=[8,2,7];

	$resultado = $carrito->EliminarEArreglo(3,[8,2,7,3]);


	$this->assertEquals($arregloc, $resultado);


	
}

/** @test **/
public function Probar_que_se_pueda_calcular_el_total() {
		$carrito = new Carrito;
		$suma = 24;

	$resultado = $carrito->calcularTotal();


	$this->assertEquals($suma, $resultado);


	
}

/** @test **/
public function Probar_que_se_pueda_buscar_en_carrito_por_id(){
	$carrito = new Carrito;

	$id = '5';
	$band=false;
	$resultado = $carrito->buscarEnCarrito($id);

	if($resultado==true)
            $band = true;


    $this->assertEquals(true, $band);
}


//NUEVO
/** @test **/
public function Probar_que_se_pueda_obtener_cantidad_productos(){
	$carrito = new Carrito;

	$array = [5, 9, 8, 3, 6];
	$cantidad2 = 0;
	foreach ($array as $pos => $value) {
		$cantidad2++;
	}

	$resultado = $carrito->cantidadProductos();

	$this->assertEquals($cantidad2, $resultado);
}

//NUEVO
/** @test **/
public function Probar_que_se_pueda_obtener_suma_total_productos(){
	$carrito = new Carrito;

	$suma=15;

	$resultado = $carrito->totalProductos();

	$this->assertEquals($suma, $resultado);
}

/** @test **/
public function Probar_que_se_pueda_agregar_carrito(){
	$carrito = new Carrito;

	$arreglo = [4,5,6,6];
	$arreglo2 = [4,5,6,6,9];

	$resultado = $carrito->agregarCarrito($arreglo, 9);

	$this->assertEquals($arreglo2, $resultado);
}


}

?>
