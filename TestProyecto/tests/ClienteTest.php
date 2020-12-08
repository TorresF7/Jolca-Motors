<?php

use App\Funciones\Cliente;

class ClienteTest extends \PHPUnit_Framework_TestCase{

    /** @test **/
    public function Probar_que_se_pueda_buscar_Cliente()
    {
        $cliente = new cliente;

        $cliente_id ='12345678';

        $resultado = $cliente->buscarCliente($cliente_id);

        if($resultado==true)
            $band = true;

        $this->assertEquals(true, $band);
    }


    /** @test **/
    public function Probar_que_se_pueda_registrar_cliente(){
        /*$sql = "call Pa_InsertarCliente (:DNI,:nombre,:apellidos,:direccion,:telefono)";

        $resultado = $this->cn->prepare($sql);*/

        $cliente = new cliente;

        $cliente_id ='22222200';
        $nombre ='pru0668';
        $apellidos ='prueba1';
        $direccion ='prueba3';
        $telefono ='123456789';
        $correo ='correo';


        $_params = array(
            'DNI'=>$cliente_id,
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'direccion' => $direccion,
            'telefono' => $telefono,
            'correo' => $correo
        );

       $resultado = $cliente->registrar($_params);


        $this->assertEquals(true, $resultado);

    }


/*NUEVAS*/

    /** @test **/
    public function Se_pueda_probar_que_fatla_campos(){
        $cliente = new cliente;

        $nombre = '';
        $email = '';
        $DNI = '12345678';

        $resultado = $cliente->isNull($nombre, $DNI, $email);

        $this->assertEquals(true, $resultado);
    }

    /** @test **/
    public function Se_pueda_probar_que_es_email(){
        $cliente = new cliente;

        $email = 'dverac@unprg.edu.pe';

        $resultado = $cliente->isEmail($email); //verifica si tiene el @

        $this->assertEquals(true, $resultado);
    }


/*20 11 2020*/

    /** @test **/
    public function Probar_que_email_Existe(){
        $cliente = new cliente;

        $band = false;

        $email = 'ftorres12@gmail.com';

        $resultado = $cliente->emailExiste($email);

        if($resultado==true)
            $band = true;

        $this->assertEquals(true, $band);
    }

    /** @test **/
    public function Probar_que_DNI_Existe(){
        $cliente = new cliente;

        $band = false;

        $DNI = '11334434';

        $resultado = $cliente->DNIExiste($DNI);

        if($resultado==true)
            $band = true;

        $this->assertEquals(true, $band);
    }

   
}
