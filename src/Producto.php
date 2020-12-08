<?php
 
namespace Kawschool;

class Producto{

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
        $sql = "call Pa_InsertarProducto (:Nombre,:Marca,:Descripcion,:Stock,:Precio,:Imagen,:IdCategoria)";

        $resultado = $this->cn->prepare($sql);


        $_array = array(
            
            ":Nombre" => $_params['Nombre'],
            ":Marca" => $_params['Marca'],
            ":Descripcion" => $_params['Descripcion'],
            ":Stock" => $_params['Stock'],
            ":Precio" => $_params['Precio'],
            ":Imagen" => file_get_contents($_params['Imagen']),
            ":IdCategoria" => $_params['IdCategoria'],
            
        );
        if($resultado->execute($_array))
            return  true;

        return false;
    }
    
    /**
     * buscarProducto
     *
     * @param  mixed $buscarProducto
     * @return void
     */
    public function buscarProducto ($buscarProducto)
    {
        $sql = "call Pa_buscar_producto_cliente('$buscarProducto')";

        $resultado = $this->cn->prepare($sql);

       if($resultado->execute()){
            return  $resultado->fetchAll();
       }else
        return false;
    }
    
    /**
     * mostrarPorId
     *
     * @param  mixed $id
     * @return void
     */
    public function mostrarPorId($id)
    {
        $sql = "call Pa_Select_producto($id)";

        $resultado = $this->cn->prepare($sql);

       if($resultado->execute())
            return  $resultado->fetchAll();

        return false;
    }
    
    /**
     * mostrarProducto
     *
     * @return void
     */
    public function mostrarProducto()
    {
        $sql = "call Pa_Select_mostrarProducto()";

        $resultado = $this->cn->prepare($sql);

       if($resultado->execute())
            return  $resultado->fetchAll();

        return false;

    }
    
    /**
     * actualizarStock
     *
     * @param  mixed $id
     * @param  mixed $stock
     * @return void
     */
    public function actualizarStock($id,$stock)
    {


        $sql = "call Pa_ActualizarStock($id,$stock)";

        $resultado = $this->cn->prepare($sql);

       if($resultado->execute())
            return  true;

        return false;
    }
    
    /**
     * actualizarProducto
     *
     * @param  mixed $codigo
     * @param  mixed $IdCategoria
     * @param  mixed $Nombre
     * @param  mixed $Marca
     * @param  mixed $Descripcion
     * @param  mixed $Stock
     * @param  mixed $Precio
     * @param  mixed $Imagen
     * @return void
     */
    public function actualizarProducto($codigo,$IdCategoria,$Nombre,$Marca,$Descripcion,$Stock,$Precio,$Imagen)
    {

        $sql = "call Pa_ActualizarProductoId($codigo,$IdCategoria,'$Nombre','$Marca','$Descripcion',$Stock,$Precio,'$Imagen')";

        $resultado = $this->cn->prepare($sql);

       if($resultado->execute())
            return  $resultado;

        return $resultado;


    }
    
    /**
     * actualizarProductoSI
     *
     * @param  mixed $codigo
     * @param  mixed $IdCategoria
     * @param  mixed $Nombre
     * @param  mixed $Marca
     * @param  mixed $Descripcion
     * @param  mixed $Stock
     * @param  mixed $Precio
     * @return void
     */
    public function actualizarProductoSI($codigo,$IdCategoria,$Nombre,$Marca,$Descripcion,$Stock,$Precio)
    {

        $sql = "call Pa_ActualizarProductoIdSI($codigo,$IdCategoria,'$Nombre','$Marca','$Descripcion',$Stock,$Precio)";

        $resultado = $this->cn->prepare($sql);

       if($resultado->execute())
            return  $resultado;

        return $resultado;


    }
    
    /**
     * ModificarEstadoProducto
     *
     * @param  mixed $codigo
     * @param  mixed $estado
     * @return void
     */
    public function ModificarEstadoProducto($codigo,$estado)
    {
        $sql = "call Pa_ActualizarEProducto($codigo,$estado)";

        $resultado = $this->cn->prepare($sql);

        if($resultado->execute())
            return  $resultado;

        return $resultado;

    }
    
    /**
     * NombreExiste
     *
     * @param  mixed $Nombre
     * @param  mixed $Descripcion
     * @param  mixed $Marca
     * @return void
     */
    public function NombreExiste($Nombre,$Descripcion,$Marca)
	{
        $sql = "call NombreProductoExiste('$Nombre','$Descripcion','$Marca')";

        $resultado = $this->cn->prepare($sql);

       if($resultado->execute())
       return  $resultado->fetchAll();

        return false;
    }    
    /**
     * NombreExisteAc
     *
     * @param  mixed $Nombre
     * @param  mixed $Descripcion
     * @param  mixed $Marca
     * @param  mixed $id
     * @return void
     */
    public function NombreExisteAc($Nombre,$Descripcion,$Marca,$id)
	{
        $sql = "call NombreProductoAExisteAc('$Nombre','$Descripcion','$Marca',$id)";

        $resultado = $this->cn->prepare($sql);

       if($resultado->execute())
       return  $resultado->fetchAll();

        return false;
	}    

}

   
