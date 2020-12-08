<?php

namespace Kawschool;

class Cliente{

    private $config;
    private $cn = null;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(){

        $this->config = parse_ini_file(__DIR__.'/../config.ini') ;

        $this->cn = new \PDO( $this->config['dns'], $this->config['usuario'],$this->config['clave'],array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ));
        
    }
    
    /**
     * buscarCliente
     *
     * @param  mixed $buscar_cliente
     * @return void
     */
    public function buscarCliente ($buscar_cliente)
    {
        $sql = "call Pa_buscar_cliente('$buscar_cliente')";

        $resultado = $this->cn->prepare($sql);

       if($resultado->execute())
            return  $resultado->fetchAll();

        return false;
    }

    
    /**
     * registrar
     *
     * @param  mixed $_params
     * @return void
     */
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


}