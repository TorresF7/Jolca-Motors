<?php

namespace Kawschool;

class Pedido{

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
    public function registrar($_params){

            $sql = "call usp_pedido_insertar(:Dni,:Estado,:Total,:Fecha,@result);";


            $resultado = $this->cn->prepare($sql);

            $_array = array(
                ":Dni" => $_params['Dni'],
                ":Estado" => $_params['Estado'],
                ":Total" => $_params['Total'],
                ":Fecha" => $_params['Fecha']
                
            );
    
        $resultado->execute($_array);
        $resultado->closeCursor(); 

        $r = $this->cn->query("SELECT @result AS `p_idpedido`");
        $total = $r->fetchColumn();
                return  $total ;

            
    }
        /**
     * CalcularTotal
     *
     * @param  mixed $id
     * @return void
     */
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
    
    /**
     * ImportarPedido
     *
     * @param  mixed $id
     * @return void
     */
    public function ImportarPedido($id){

       
        $sql = "call Pa_listarDetalles($id)";

        $resultado = $this->cn->prepare($sql);

       if($resultado->execute()){
        return  $resultado->fetchAll();

       }

       

        return false;
    }
    
        
    /**
     * registrarImportacion
     *
     * @param  mixed $_params
     * @return void
     */
    public function registrarImportacion($_params)
    {
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

        return $resultado;
    }
    
    /**
     * SelectPedido
     *
     * @param  mixed $idPedido
     * @return void
     */
    public function SelectPedido($idPedido)
    {
        $sql = "call Pa_Select_pedido($idPedido)";
        $resultado = $this->cn->prepare($sql);
    
            if($resultado->execute())
                return  $resultado->fetchAll();
            return false;
    }
    
    /**
     * registrarDetalle
     *
     * @param  mixed $_params
     * @return void
     */
    public function registrarDetalle($_params){
            $sql = "call Pa_InsertarDetalle (:producto_id,:pedido_id,:cantidad,:precio,:subtotal)";


            $resultado = $this->cn->prepare($sql);

            $_array = array(
                ":pedido_id" => $_params['pedido_id'],
                ":producto_id" => $_params['producto_id'],
                ":precio" => $_params['precio'],
                ":subtotal" => $_params['subtotal'],
                ":cantidad" => $_params['cantidad'],
            );

            if($resultado->execute($_array))
                return  true;

            return false;
    }
    
    /**
     * verificar
     *
     * @param  mixed $id
     * @return void
     */
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
    
    /**
     * CambiarEstado
     *
     * @param  mixed $estado
     * @param  mixed $id
     * @return void
     */
    public function CambiarEstado($estado,$id){


            $sql = "call Pa_ActualizarEPedido($estado,$id)";

            $resultado = $this->cn->prepare($sql);
            if($resultado->execute())
                return  true;
            
            return false;
        
    }   

      /**
     * ListarDetalles
     *
     * @param  mixed $id
     * @return void
     */
    public function ListarDetalles($id){
        $sql = "call Pa_listarDetalles($id)";

        $resultado = $this->cn->prepare($sql);


        if($resultado->execute())
            return  $resultado->fetchAll();

        return false;

    }    

    /**
     * ListarDetallesId
     *
     * @param  mixed $id
     * @param  mixed $producto
     * @return void
     */
    public function ListarDetallesId($id,$producto){
            $sql = "call Pa_SelectDetalleId($id,$producto)";

            $resultado = $this->cn->prepare($sql);


            if($resultado->execute())
                return  $resultado->fetchAll();

            return false;

    }     
    
    /**
     * EliminarDetalle
     *
     * @param  mixed $id
     * @param  mixed $producto
     * @return void
     */
    public function EliminarDetalle($id,$producto){


        $sql = "call Pa_EliminarDetalle($id,$producto)";

        $resultado = $this->cn->prepare($sql);
         if($resultado->execute())
            return  true;
        
        return false;
      
    }   
    
    /**
     * ModificarEstadoDetalle
     *
     * @param  mixed $id
     * @param  mixed $producto
     * @param  mixed $estado
     * @return void
     */
    public function ModificarEstadoDetalle($id,$producto,$estado)
    {

        $sql = "call Pa_ActualizarEDetalle($id,$producto,$estado)";

        $resultado = $this->cn->prepare($sql);
         if($resultado->execute())
            return  true;
        
        return false;
      
    }  
    
    /**
     * ModificarDetalle
     *
     * @param  mixed $id
     * @param  mixed $producto
     * @param  mixed $cantidad
     * @return void
     */
    public function ModificarDetalle($id,$producto,$cantidad){


        $sql = "call Pa_ActualizarDetalleId($id,$producto,$cantidad)";

        $resultado = $this->cn->prepare($sql);
         if($resultado->execute())
            return  true;
        
        return false;
      
    }   
    

    
    /**
     * ActualizarTotal
     *
     * @param  mixed $total
     * @param  mixed $id
     * @return void
     */
    public function ActualizarTotal($total,$id)
    {


        $sql = "call Pa_ActualizarTPedido($total,$id)";

        $resultado = $this->cn->prepare($sql);
         if($resultado->execute())
            return  true;
        
        return false;
      
    }   

    
    /**
     * ListarPedidoFecha
     *
     * @param  mixed $anioActualFin
     * @return void
     */
    public function ListarPedidoFecha($anioActualFin){
        $sql = "call Pa_Select_PedidoFecha($anioActualFin)";

        $resultado = $this->cn->prepare($sql);


        if($resultado->execute())
            return  $resultado->fetchAll();
        return false;
   } 

   
    // Listar Venta segun Id    
    /**
     * ListarVenta
     *
     * @param  mixed $idPedido
     * @return void
     */
    public function ListarVenta($idPedido){
        $sql ="SELECT * FROM pedido as P INNER JOIN venta as V
               ON  P.IdPedido = V.IdPedido
               WHERE P.IdPedido = '$idPedido'";
        $resultado = $this->cn->prepare($sql);

        if($resultado->execute())
           return $resultado->fetchAll();
        return false;
    }
    
    /**
     * SelectPedidoId
     *
     * @param  mixed $idPedido
     * @return void
     */
    public function SelectPedidoId($idPedido){
        $sql = "SELECT C.Nombres, C.Apellidos, C.Dni, C.Telefono, C.Direccion FROM pedido as P JOIN cliente as C ON P.Dni = C.Dni 
        WHERE P.IdPedido = '$idPedido'";
        $resultado = $this->cn->prepare($sql);

            if($resultado->execute())
                return  $resultado->fetchAll();
            return false;
    }
    
    /**
     * ListarPedido
     *
     * @return void
     */
    public function ListarPedido(){
            $sql = $sql = "SELECT C.Dni, C.Nombres, C.Apellidos, P.IdPedido, P.Dni, P.Fecha, P.Total, P.Estado FROM cliente as C JOIN pedido
                    as P ON C.Dni = P.Dni
                    WHERE P.Estado = 1";

            $resultado = $this->cn->prepare($sql);

            if($resultado->execute())
                return  $resultado->fetchAll();

            return false;

    }
    
    /**
     * ListarPedidoEstado
     *
     * @param  mixed $estado
     * @return void
     */
    public function ListarPedidoEstado($estado){
        $sql = $sql = "SELECT C.Dni, C.Nombres, C.Apellidos, P.IdPedido, P.Dni, P.Fecha, 
              P.Total, P.Estado FROM cliente as C JOIN pedido
                as P ON C.Dni = P.Dni
                WHERE P.Estado = '$estado'";

        $resultado = $this->cn->prepare($sql);

        if($resultado->execute())
            return  $resultado->fetchAll();

        return false;

    }    
    


}