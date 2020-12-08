<?php

namespace App\Funciones;

class Pedido{

    private $config;
    private $cn = null;

    public function __construct(){

        $this->config = parse_ini_file(__DIR__.'/../config.ini') ;

        $this->cn = new \PDO( $this->config['dns'], $this->config['usuario'],$this->config['clave'],array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ));
        
    }
    
    public function ListarPedido()
    {
        $sql = $sql = "SELECT C.Dni, C.Nombres, C.Apellidos, P.IdPedido, P.Dni, P.Fecha, P.Total, P.Estado FROM cliente as C JOIN pedido
                as P ON C.Dni = P.Dni
                WHERE P.Estado = 1";

        $resultado = $this->cn->prepare($sql);

        if($resultado->execute())
            return  $resultado->fetchAll();

        return false;

    }


     public function registrar($_params){
        $sql = "INSERT INTO `pedido`(`Dni`, `Estado`, `Total`,`Fecha`) 
        VALUES (:Dni,:Estado,:Total,:Fecha)";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":Dni" => $_params['Dni'],
            ":Estado" => $_params['Estado'],
            ":Total" => $_params['Total'],
            ":Fecha" => $_params['Fecha'],
            
        );

        if($resultado->execute($_array))
            return $this->cn->lastInsertId();

        return false;
    }



public function registrarDetalle($_params){
        $sql = "call Pa_InsertarDetalle (:producto_id,:pedido_id,:cantidad,:precio,:subtotal)";


        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":pedido_id" => $_params['pedido_id'],
            ":producto_id" => $_params['producto_id'],
            ":precio" => $_params['precio'],
            ":cantidad" => $_params['cantidad'],
            ":subtotal" => $_params['subtotal'],
        );

        if($resultado->execute($_array))
            return  true;

        return false;
    }



    /*NUEVAS 25102020*/

    public function SelectPedidoId($idPedido){
        $sql = "SELECT 
                C.Nombres, 
                C.Apellidos, 
                C.Dni, 
                C.Telefono, 
                C.Direccion 
                FROM pedido as P 
                JOIN cliente as C 
                ON P.Dni = C.Dni 
                WHERE P.IdPedido = '$idPedido'";

        $resultado = $this->cn->prepare($sql);

        if($resultado->execute())
            return  $resultado->fetchAll();

        return false;
    }

    public function ListarPedidoEstado($estado){
        
        $sql = $sql = "SELECT 
                        C.Dni, 
                        C.Nombres, 
                        C.Apellidos, 
                        P.IdPedido, 
                        P.Dni, 
                        P.Fecha, 
                        P.Total, 
                        P.Estado 
                        FROM cliente as C 
                        JOIN pedido as P 
                        ON C.Dni = P.Dni
                        WHERE P.Estado = '$estado'";

        $resultado = $this->cn->prepare($sql);

        if($resultado->execute())
            return  $resultado->fetchAll();

        return false;

    }

    public function ListarDetalles($id){
        $sql = "call Pa_listarDetalles($id)";

        $resultado = $this->cn->prepare($sql);

        if($resultado->execute())
            return  $resultado->fetchAll();

        return false;

    }

    // El Pa_SelectDetalleId($id,$producto) creo que está mal
    public function ListarDetallesId($id,$producto){
        $sql = "call Pa_SelectDetalleId($id,$producto)";

        $resultado = $this->cn->prepare($sql);

        if($resultado->execute())
            return  $resultado->fetchAll();

        return false;

    }

    public function verificar($id){

        $band=0;
        $sql = "call Pa_verificar($id)";

        $resultado = $this->cn->prepare($sql);

        if($resultado->execute()){
            foreach($resultado as $verificar):
                if($verificar['Cantidad']>$verificar['Stock']){
                    $band=1;
                }
                
            endforeach;
        }

        return $band;
    }

    public function CambiarEstado($estado,$id){

        $sql = "call Pa_ActualizarEPedido($estado,$id)";

        $resultado = $this->cn->prepare($sql);
         if($resultado->execute())
            return  true;
        
        return false;
      
    }

    public function EliminarDetalle($id,$producto){

        $sql = "call Pa_EliminarDetalle($id,$producto)";

        $resultado = $this->cn->prepare($sql);
         if($resultado->execute())
            return  true;
        
        return false;
      
    }

    public function ModificarEstadoDetalle($id,$producto,$estado)
    {

        $sql = "call Pa_ActualizarEDetalle($id,$producto,$estado)";

        $resultado = $this->cn->prepare($sql);
         if($resultado->execute())
            return  true;
        
        return false;
      
    }

    public function ModificarDetalle($id,$producto,$cantidad){

        $sql = "call Pa_ActualizarDetalleId($id,$producto,$cantidad)";

        $resultado = $this->cn->prepare($sql);
         if($resultado->execute())
            return  true;
        
        return false;
    }

// --------------------------------------

    public function CalcularTotal($id){

        $total=0;
        $sql = "call Pa_listarDetalles($id)";

        $resultado = $this->cn->prepare($sql);

       if($resultado->execute()){
            foreach($resultado as $verificar):
                $total=$total+$verificar['Subtotal'];
                
            endforeach;
       }

        return $total;
    }

    public function ImportarPedido($id){
       
        $sql = "call Pa_listarDetalles($id)";

        $resultado = $this->cn->prepare($sql);

        if($resultado->execute()){
            return  $resultado->fetchAll();
        }

        return false;
    }

    public function registrarImportacion($_params){
        $sql = "call Pa_InsertarImportacion(:pedido_id,:idUsuario,:Fecha,:producto_id,:cantidad)";


        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":pedido_id" => $_params['pedido_id'],
            ":idUsuario" => $_params['idUsuario'],
            ":Fecha" => $_params['Fecha'],
            ":producto_id" => $_params['producto_id'],
            ":cantidad" => $_params['cantidad']
        );

        if($resultado->execute($_array))
            return  true;

        //return $resultado;
        return false;
    }

    public function SelectPedido($idPedido){
        $sql = "call Pa_Select_pedido($idPedido)";
        $resultado = $this->cn->prepare($sql);
    
            if($resultado->execute())
                return  $resultado->fetchAll();
            return false;
    }

//07112020
    public function ActualizarTotal($total,$id){


        $sql = "call Pa_ActualizarTPedido($total,$id)";

        $resultado = $this->cn->prepare($sql);
         if($resultado->execute())
            return  true;
        
        return false;
      
    }
/*
//11112020
    public function ListarPedidoInicio($anioActualFin){
        $sql = "call Pa_Select_PedidoFecha($anioActualFin)";

        $resultado = $this->cn->prepare($sql);


        if($resultado->execute())
            return  $resultado->fetchAll();
        return false;
   } 

    public function ListarPedidoFin($anioActualFin){
        $sql = "call Pa_Select_PedidoFecha($anioActualFin)";

        $resultado = $this->cn->prepare($sql);


        if($resultado->execute())
            return  $resultado->fetchAll();
        return false;
    }
    */
}