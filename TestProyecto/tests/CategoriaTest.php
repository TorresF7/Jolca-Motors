<?php

use App\Funciones\Categoria;

class CategoriaTest extends \PHPUnit_Framework_TestCase{

//11112020
	/** @test **/
    public function Probar_que_se_pueda_mostrar_la_categoria()
    {
        $categoria = new categoria;

        $band = false;

        $resultado = $categoria->mostrarCategoria();

        if($resultado==true)
            $band = true;

        $this->assertEquals(true, $band);
    }
}