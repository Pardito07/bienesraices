<?php

namespace MVC;

class Router{

    //Arreglos para almacenar las rutas POST y GET
    public $rutasGET = [];
    public $rutasPOST = [];

    //Asignar a las rutas GET la URL y la funcion del controller
    public function get($url, $fn){
        $this->rutasGET[$url] = $fn;
    }

    //Asignar a las rutas POST la URL y la funcion del controller
    public function post($url, $fn){
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas(){

        session_start();

        $auth = $_SESSION['login'] ?? null;

        $rutasProtegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear', 'vendedores/actualizar', 'vendedores/eliminar'];

        //Obtener datos del servidor
        $urlActual = $_SERVER['REQUEST_URI'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo === 'GET'){

            $urlActual = explode('?',$urlActual)[0];
            //Asignar a la variable la URL que se esta visitando
            $fn = $this->rutasGET[$urlActual] ?? null;
        }else {

            $urlActual = explode('?',$urlActual)[0];
            //Asignar a la variable la URL a la que se enviara la peticion POST
            $fn = $this->rutasPOST[$urlActual] ?? null;            
        }

        if(in_array($urlActual, $rutasProtegidas) && !$auth){
            header('Location: /');
        }

        //Validar si existe la URL que se esta visitando
        if($fn){

            //Ejecutar la funcion del controller asignada a la ruta que se esta visitando
            call_user_func($fn, $this);
        }else {
            echo 'Pagina no encontrada';
        }
    }

    //Metodo para renderizar la vista cuando se visita una URL
    public function render($view, $datos = []){

        //Obtener los datos que se estan enviando hacia la vista
        foreach($datos as $key => $value){
            $$key = $value;
        }

        //Iniciar el buffer
        ob_start();
        include __DIR__ . "/views/$view.php";

        //Finalizar y limpiar el buffer
        $contenido = ob_get_clean();
        
        include __DIR__ . '/views/layout.php';
    }

}