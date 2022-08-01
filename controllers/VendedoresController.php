<?php

namespace Controller;
use MVC\Router;
use Model\Vendedor;

class VendedoresController{

    public static function crear(Router $router){

        //Obtener los errores
        $errores = Vendedor::getErrores();

        //Crear una instancia de la clase vacia
        $vendedores = new Vendedor();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //Mandar datos al constructor
            $vendedor = new Vendedor($_POST['vendedor']);
            
            //Validar errores
            $errores = $vendedor->validar();
    
            //Guardar en la BD
            if(empty($errores)){
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/crear', [
            'errores' => $errores,
            'vendedor' => $vendedores
        ]);
    }

    public static function actualizar(Router $router){
        
        //Validar el id de la URL
        $id = validarORedireccionar('/admin');

        //Obtener los errores
        $errores = Vendedor::getErrores();

        //Obtener la propiedad por el id
        $vendedor = Vendedor::find($id);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $args = $_POST['vendedor'];
    
            //Sincronizar el objeto en memoria
            $vendedor->sincronizar($args);
    
            //Validar los errores
            $errores = $vendedor->validar();
    
            if(empty($errores)){

                //Guardar el la BD
                $vendedor->guardar();
            }
        }

        $router->render('/vendedores/actualizar', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }

    public static function eliminar(){
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //Validar el id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){

                //Obtener el tipo de registro a eliminar
                $tipo = $_POST['tipo'];
                
                if(validarTipoContenido($tipo)){

                    //Encontrar el registro a eliminar
                    $vendedor = Vendedor::find($id);

                    //Eliminar el registro
                    $vendedor->eliminar();
                }
            }
        }
    }
}