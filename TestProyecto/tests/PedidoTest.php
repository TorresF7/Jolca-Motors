<?php

use App\Funciones\Pedido;
use App\Funciones\Cliente;

class PedidoTest extends \PHPUnit_Framework_TestCase{

    /** @test **/
    public function Probar_que_se_puede_Listar_Pedido()
    {

        $pedido = new pedido;

        $resultado = $pedido->ListarPedido();

        if($resultado==true)
            $band = true;

        $this->assertEquals(true, $band);

    }

     /** @test **/
     public function Probar_que_se_puede_registrar_el_pedido(){

        $valor = 0;
        $pedido = new pedido;

        $Dni = '12345678';
        $Estado = 'prueba2';
        $Total = 'prueba2';
        $Fecha = 'prueba2';



        $_params = array(
            'Dni' => $Dni,
            'Estado' => $Estado,
            'Total' => $Total,
            'Fecha' => $Fecha,
            
        );

        $resultado = $pedido->registrar($_params);
        if(is_numeric($resultado)){
        $valor = 1;
            
        }
        
        $this->assertEquals(1, $valor);

       
    }


/** @test **/
public function Probar_que_se_puede_registrar_Detalle(){
    
        
        $pedido = new pedido;

        $pedido_id = '3';
        $producto_id = '1';
        $precio = '1.84';
        $cantidad = '4';
        $subtotal = '4.65';

        $_params = array(
            'pedido_id' => $pedido_id,
            'producto_id' => $producto_id,
            'precio' => $precio,
            'cantidad' => $cantidad,
            'subtotal' => $subtotal,
        );

        $resultado = $pedido->registrarDetalle($_params);
        
        /*if($resultado==true)
            $band = true;*/
        
        $this->assertEquals(true, $resultado);
    }



    /* NUEVAS 25102020*/
    /** @test **/
    public function Probar_que_se_pueda_mostrar_pedido_por_id(){
        $pedido = new pedido;

        $idPedido = '6';
        $band = false;

        $resultado = $pedido->SelectPedidoId($idPedido);

        if($resultado==true)
            $band = true;

        $this->assertEquals(true, $band);
    }

    /** @test **/
    public function Probar_que_se_pueda_mostrar_pedido_por_estado(){
        $pedido = new pedido;

        $estado = '2';
        $band = false;

        $resultado = $pedido->ListarPedidoEstado($estado);

        if($resultado==true)
            $band = true;

        $this->assertEquals(true, $band);
    }

    /** @test **/
    public function Probar_que_se_pueda_listar_detalle_pedido_por_id(){
        $pedido = new pedido;

        $id = '2';
        $band = false;

        $resultado = $pedido->ListarDetalles($id);

        if($resultado==true)
            $band = true;

        $this->assertEquals(true, $band);
    }

    /** @test **/
    public function Probar_que_se_pueda_verificar_por_id(){
        $pedido = new pedido;

        $id = '10'; // porque cumple con la condicion de la funcion
        $band = 0;

        $resultado = $pedido->verificar($id);

        if($resultado==1)
            $band = 1;

        $this->assertEquals(1, $band);
    }

    /** @test **/
    public function Probar_que_se_pueda_cambiar_el_estado_de_pedido(){
        $pedido = new pedido;

        $id = '1';
        $estado = '4';
        $band = false;

        $resultado = $pedido->CambiarEstado($id, $estado);

        if($resultado==true)
            $band = true;

        $this->assertEquals(true, $band);
    }

    /** @test **/
    public function Probar_que_se_pueda_eliminar_el_detallePedido(){
        $pedido = new pedido;

        $idPedido = '16';
        $idProducto = '81';
        $band = false;

        $resultado = $pedido->EliminarDetalle($idPedido, $idProducto);

        if($resultado==true)
            $band = true;

        $this->assertEquals(true, $band);
    }

    /** @test **/
    public function Probar_que_se_pueda_cambiar_el_estado_de_detallePedido(){
        $pedido = new pedido;

        $estado = '3';
        $idPedido = '9';
        $idProducto = '24';
        
        $band = false;

        $resultado = $pedido->ModificarEstadoDetalle($idPedido, $idProducto, $estado);

        if($resultado==true)
            $band = true;

        $this->assertEquals(true, $band);
    }

    /** @test **/
    public function Probar_que_se_pueda_actualizar_la_cantidad_del_detallePedido(){
        $pedido = new pedido;

        $idPedido = '9';
        $idProducto = '24';
        $cantidad = '7';
        
        $band = false;

        $resultado = $pedido->ModificarDetalle($idPedido, $idProducto, $cantidad);

        if($resultado==true)
            $band = true;

        $this->assertEquals(true, $band);
    }

    // hacer otra solición *
    /** @test **/
    public function Probar_que_se_pueda_calcularTotal(){
        $pedido = new pedido;

        $subtotal = '17.16';
        $idPedido = '5';
        
        $band = false;

        $resultado = $pedido->CalcularTotal($idPedido);

        if($resultado==$subtotal)
            $band = true;

        $this->assertEquals(true, $band);
    }

    /** @test **/
    public function Probar_que_se_pueda_importar_pedido(){
        $pedido = new pedido;

        $idPedido = '9';
        
        $band = false;

        $resultado = $pedido->ImportarPedido($idPedido);

        if($resultado==true)
            $band = true;

        $this->assertEquals(true, $band);
    }

    /** @test **/
    public function Probar_que_se_pueda_registrar_importación(){
    
        
        $pedido = new pedido;

        $band = false;

        $pedido_id = '3';
        $idUsuario = '1';
        $fecha = '2020-10-24 12:30:52';
        $producto_id = '4';
        $cantidad = '5';

        $_params = array(
            'pedido_id' => $pedido_id,
            'idUsuario' => $idUsuario,
            'Fecha' => $fecha,
            'producto_id' => $producto_id,
            'cantidad' => $cantidad,
        );

        $resultado = $pedido->registrarImportacion($_params);
        
        if($resultado==true)
            $band = true;
        
        $this->assertEquals(true, $band);
    }

    /** @test **/
    public function Probar_que_se_pueda_mostrar_solo_pedido_por_id(){
        $pedido = new pedido;

        $idPedido = '11';
        $band = false;

        $resultado = $pedido->SelectPedido($idPedido);

        if($resultado==true)
            $band = true;

        $this->assertEquals(true, $band);
    }

//07112020
    /** @test **/
    public function Probar_que_se_pueda_actualizar_total(){
        $pedido = new pedido;

        $total = '201';
        $idPedido = '1';
        $band = false;

        $resultado = $pedido->ActualizarTotal($total, $idPedido);

        if($resultado==true)
            $band = true;

        $this->assertEquals(true, $band);
    }

//11112020
    /** @test **//*
    public function probar_que_se_pueda_listar_pedido_inicio(){
        $pedido = new pedido;

        $anioActualFin = '2020-10-23 21:48:37';
        $band = false;

        $resultado = $pedido->ListarPedidoInicio($anioActualFin);

        if($resultado==true)
            $band = true;

        $this->assertEquals(true, $band);
    }*/
}