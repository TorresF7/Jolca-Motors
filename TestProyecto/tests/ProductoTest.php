<?php


use App\Funciones\Producto;
class ProductoTest extends \PHPUnit_Framework_TestCase{


/** @test **/
    public function Probar_que_se_puede_buscar_Producto()
    {

        $producto = new producto;
        $band = false;

        $Nombre = 'Luxxan';
        $resultado1 = $producto->buscarProducto($Nombre);

        $Marca = 'Luxxan';
        $resultado2 = $producto->buscarProducto($Marca);

        $Descripcion = '35/65R17 INSPIRET F2';
        $resultado3 = $producto->buscarProducto($Descripcion);

        if($resultado1==true || $resultado2==true || $resultado3==true)
            $band = true;

        $this->assertEquals(true, $band);


    }

    /** @test **/
    public function Probar_que_se_pueda_mostrar_producto_por_id()
    {
        $producto = new producto;

        $id = '6';
        $band = false;

        $resultado = $producto->buscarProducto($id);

        if($resultado==true)
            $band = true;

        $this->assertEquals(true, $band);
    }

    //NUEVO
    /** @test **/
    public function Probar_que_se_pueda_obtener_descripcion_del_producto()
    {

        $producto = new producto;

        $id = '6';
        $band = false;

        $resultado = $producto->obtenerDescripcionProducto($id);

        if($resultado==true)
            $band = true;


        $this->assertEquals(true, $band);

    }

    //NUEVO
    /** @test **/
    public function Probar_que_se_puede_listar_Productos(){

        $producto = new producto;

        $band = false;

        $resultado = $producto->listarProductos();

        if($resultado==true)
            $band = true;

        $this->assertEquals(true, $band);

    }

// 07112020
    /** @test **/
    public function Probar_que_se_pueda_actualizar_el_stock(){
        $producto = new producto;

        $band = false;
        $id = '2';
        $stock = '160';

        $resultado = $producto->actualizarStock($id, $stock);

        if($resultado==true)
            $band = true;

        $this->assertEquals(true, $band);
    }

    /** @test **/
    public function Probar_que_se_pueda_actualizar_el_producto(){
        $producto = new producto;

        $codigo = '25';
        $IdCategoria = '2';
        $Nombre = 'producto';
        $Marca = 'marca';
        $Descripcion = 'Descripcion';
        $Stock = '69';
        $Precio = '69';
        $Imagen = 'imagen';

        $resultado = $producto->actualizarProducto($codigo,$IdCategoria,$Nombre,$Marca,$Descripcion,$Stock,$Precio,$Imagen);

        if($resultado==true)
            $band = true;

        $this->assertEquals(true, $band);
    }

    /** @test **/
    public function Probar_que_se_pueda_actualizar_el_producto_SI(){
        $producto = new producto;

        $codigo = '25';
        $IdCategoria = '2';
        $Nombre = 'producto2';
        $Marca = 'marca2';
        $Descripcion = 'Descripcion2';
        $Stock = '692';
        $Precio = '692';

        $resultado = $producto->actualizarProductoSI($codigo,$IdCategoria,$Nombre,$Marca,$Descripcion,$Stock,$Precio);

        if($resultado==true)
            $band = true;

        $this->assertEquals(true, $band);
    }

    /** @test **/
    public function Probar_que_se_pueda_registrar_producto(){

        $producto = new producto;

        $Nombre ='producto3';
        $Marca ='marca3';
        $Descripcion ='Descripcion3';
        $Stock ='79';
        $Precio ='79';
        $Imagen ='imagen';
        $IdCategoria = '2';


        $_params = array(
            'Nombre'=>$Nombre,
            'Marca' => $Marca,
            'Descripcion' => $Descripcion,
            'Stock' => $Stock,
            'Precio' => $Precio,
            'Imagen' => $Imagen,
            'IdCategoria' => $IdCategoria
        );

       $resultado = $producto->registrar($_params);


        $this->assertEquals(true, $resultado);

    }

    /** @test **/
    public function Probar_que_se_pueda_modificar_el_estado_del_producto(){
        $producto = new producto;

        $band = false;
        $codigo = '25';
        $estado = '1';

        $resultado = $producto->ModificarEstadoProducto($codigo, $estado);

        if($resultado==true)
            $band = true;

        $this->assertEquals(true, $band);
    }
}
