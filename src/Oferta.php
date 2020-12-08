<?php

namespace Kawschool;

class Oferta{

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
        * mostrarPorId
        *
        * @param  mixed $id
        * @return void
        */
       public function mostrarPorId($id)
    {


        $sql = "call Pa_Select_ofertasId($id)";

        $resultado = $this->cn->prepare($sql);

       if($resultado->execute())
            return  $resultado->fetchAll();

        return false;
    }

}

