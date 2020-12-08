<?php

namespace App\Funciones;

class Cliente{

    private $config;
    private $cn = null;

    public function __construct(){

        $this->config = parse_ini_file(__DIR__.'/../config.ini') ;

        $this->cn = new \PDO( $this->config['dns'], $this->config['usuario'],$this->config['clave'],array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ));

    }


    public function buscarCliente ($buscar_cliente)
    {


        $sql = "call Pa_buscar_cliente('$buscar_cliente')";

        $resultado = $this->cn->prepare($sql);

       if($resultado->execute())
            return  $resultado->fetchAll();

        return false;
    }

    public function registrar($_params){
        $sql = "call Pa_InsertarCliente (:DNI,:nombre,:apellidos,:direccion,:telefono,:correo)";

        $resultado = $this->cn->prepare($sql);


        $_array = array(
            ":DNI" => $_params['DNI'],
            ":nombre" => $_params['nombre'],
            ":apellidos" => $_params['apellidos'],
            ":direccion" => $_params['direccion'],
            ":telefono" => $_params['telefono'],
            ":correo" => $_params['correo'],
            
        );
        if($resultado->execute($_array))
            return  true;

        return false;
    }

/*NUEVAS*/
    function isNull($nombre, $DNI, $email){
        if(strlen(trim($nombre)) < 1 || strlen(trim($DNI)) < 1 || strlen(trim($email)) < 1)
        {
            return true;
            } else {
            return false;
        }       
    }
    
    function isEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
            } else {
            return false;
        }
    }


/*20 11 2020*/

    function DNIExiste($DNI)
    {
        

        $sql = "SELECT DNI FROM cliente WHERE DNI = '$DNI' LIMIT 1";

        $resultado = $this->cn->prepare($sql);

       if($resultado->execute())
            return  $resultado->fetchAll();

        return false;
    }
    
    function emailExiste($email)
    {
       
        $sql = "SELECT Dni FROM cliente WHERE correo = '$email' LIMIT 1";

        $resultado = $this->cn->prepare($sql);

       if($resultado->execute())
            return  $resultado->fetchAll();

        return false;

    }


    
}
