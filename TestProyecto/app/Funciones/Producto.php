<?php

namespace App\Funciones;

class Producto{

    private $config;
    private $cn = null;

    public function __construct(){

        $this->config = parse_ini_file(__DIR__.'/../config.ini') ;

        $this->cn = new \PDO( $this->config['dns'], $this->config['usuario'],$this->config['clave'],array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ));
        
    }


    public function buscarProducto ($buscarProducto)
    {


        $sql = "call Pa_buscar_producto_cliente('$buscarProducto')";

        $resultado = $this->cn->prepare($sql);

       if($resultado->execute())
            return  $resultado->fetchAll();

        return false;
    }

       public function mostrarPorId($id)
    {


        $sql = "call Pa_Select_producto($id)";

        $resultado = $this->cn->prepare($sql);

       if($resultado->execute())
            return  $resultado->fetchAll();

        return false;
    }

//NUEVO
    public function obtenerDescripcionProducto ($id)
    {


        $sql = "call Pa_Select_producto($id)";

        $resultado = $this->cn->prepare($sql);

       if($resultado->execute())
            return  $resultado->fetchAll();

        return false;
    }

//NUEVO
    
    public function listarProductos()
    {
        $sql = "SELECT SQL_CALC_FOUND_ROWS *
                        FROM producto  JOIN oferta ON IdProducto_O=IdProducto
                        
                        ORDER BY IdProducto";  //quito por el momento las variables $inicio y $producto_por_pagina

        $resultado = $this->cn->prepare($sql);

        if($resultado->execute())
            return  $resultado->fetchAll();

        return false;

        //WHERE FechaInicio < NOW() AND NOW()<FechaCaduc

    }

//07112020
    public function actualizarStock($id,$stock)
    {


        $sql = "call Pa_ActualizarStock($id,$stock)";

        $resultado = $this->cn->prepare($sql);

       if($resultado->execute())
            return  true;

        return false;
    }

    public function actualizarProducto($codigo,$IdCategoria,$Nombre,$Marca,$Descripcion,$Stock,$Precio,$Imagen){

        $sql = "call Pa_ActualizarProductoId($codigo,$IdCategoria,'$Nombre','$Marca','$Descripcion',$Stock,$Precio,'$Imagen')";

        $resultado = $this->cn->prepare($sql);

       if($resultado->execute())
            return  $resultado;


        //return $resultado;
        return false;

    }

    public function actualizarProductoSI($codigo,$IdCategoria,$Nombre,$Marca,$Descripcion,$Stock,$Precio){

        $sql = "call Pa_ActualizarProductoIdSI($codigo,$IdCategoria,'$Nombre','$Marca','$Descripcion',$Stock,$Precio)";

        $resultado = $this->cn->prepare($sql);

       if($resultado->execute())
            return  $resultado;

        //return $resultado;
        return false;


    }

    public function registrar($_params){
        $sql = "call Pa_InsertarProducto (:Nombre,:Marca,:Descripcion,:Stock,:Precio,:Imagen,:IdCategoria)";

        $resultado = $this->cn->prepare($sql);


        $_array = array(
            
            ":Nombre" => $_params['Nombre'],
            ":Marca" => $_params['Marca'],
            ":Descripcion" => $_params['Descripcion'],
            ":Stock" => $_params['Stock'],
            ":Precio" => $_params['Precio'],
            //":Imagen" => file_get_contents($_params['Imagen']),
            ":Imagen" => $_params['Imagen'],
            ":IdCategoria" => $_params['IdCategoria'],
            
        );
        if($resultado->execute($_array))
            return  true;

        return false;
    }


//11112020
    public function ModificarEstadoProducto($codigo,$estado){
        $sql = "call Pa_ActualizarEProducto($codigo,$estado)";

        $resultado = $this->cn->prepare($sql);

        if($resultado->execute())
            return  $resultado;

        //return $resultado;
        return false;


    }
}


