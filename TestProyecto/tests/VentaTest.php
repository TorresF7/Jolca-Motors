<?php

use App\Funciones\Venta;

class VentaTest extends \PHPUnit_Framework_TestCase {

	/** @test **/
    public function Probar_que_se_pueda_registrar_venta(){
    
        
        $venta = new venta;

        $band = false;

        $IdPedido = '3';
        $IdUsuario = '1';
        $Fecha = '2020-10-21 14:45:25';
        $Total = '4';

        $_params = array(
            'IdPedido' => $IdPedido,
            'IdUsuario' => $IdUsuario,
            'Fecha' => $Fecha,
            'Total' => $Total,
        );

        $resultado = $venta->registrar($_params);
        
        if($resultado==true)
            $band = true;
        
        $this->assertEquals(true, $band);
    }
}