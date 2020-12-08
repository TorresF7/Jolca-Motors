<?php

namespace Kawschool;

class Venta{

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
     * registrar
     *
     * @param  mixed $_params
     * @return void
     */
    public function registrar($_params)
    {
        $sql = "call Pa_InsertarVenta (:IdPedido,:IdUsuario,:Fecha,:Total)";

        $resultado = $this->cn->prepare($sql);


        $_array = array(
            ":IdPedido" => $_params['IdPedido'],
            ":IdUsuario" => $_params['IdUsuario'],
            ":Fecha" => $_params['Fecha'],
            ":Total" => $_params['Total']
        );
        if($resultado->execute($_array))
            return  true;

        return false;
    }


}