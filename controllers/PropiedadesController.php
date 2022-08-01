<?php

namespace Controller;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadesController{

    //Metodo asignado a la URL principal
    public static function index(Router $router /*Mantener la referencia del router*/){

        //Metodo para listar todas la propiedades
        $propiedades = Propiedad::all();

        $vendedores = Vendedor::all();

        //Obtener los errores
        $errores = Propiedad::getErrores();

        $resultado = $_GET['resultado'] ?? null;

        //Asignar la vista que se va a renderizar y un array con datos que se van a pasar hacia la vista
        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }

    public static function crear(Router $router){

        //Instancia para crear una nueva propiedad
        $propiedad = new Propiedad();

        //Metodo para listar todos los vendedores
        $vendedores = Vendedor::all();

        //Obtener los errores
        $errores = Propiedad::getErrores();


        //Validar que el Request Method sea POST
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            //Enviar los datos al constructor
            $propiedad = new Propiedad($_POST['propiedad']);

            //Crear nombre unico para las imagenes
            $nombreImagen = md5( uniqid( rand(), true ) ) . '.jpg';
                
            //Resize a la imagen subida
            if($_FILES['propiedad']['tmp_name']['imagen']){

                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);

                //Setear la imagen en el atributo de la clase
                $propiedad->setImagen($nombreImagen);

            }

            //Validar los errores
            $errores = $propiedad->validar();

            //Insertar los datos si no hay campos vacios
            if(empty($errores)){

                //Si el directorio no existe se crea la carpeta
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }
                
                //Guardar la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);

                //Guardar la propiedad en la base de datos
                $propiedad->guardar();

            }
        }

        //Asignar la vista que se va a renderizar y un array con datos que se van a pasar hacia la vista
        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router){
        
        //Validar que sea un id valido
        $id = validarORedireccionar('/admin');

        //Buscar la propiedad por su id
        $propiedad = Propiedad::find($id);

        //Obtener los vendedores
        $vendedores = Vendedor::all();

        //Obtener los errores
        $errores = Propiedad::getErrores();

        //Validar que el REQUEST_METHOD sea POST
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $args = $_POST['propiedad'];

            //Sincronizar el objeto en memoria
            $propiedad->sincronizar($args);

            //Validar los errores
            $errores = $propiedad->validar();

            //Crear un nombre unico para la imagen
            $nombreImagen = md5( uniqid( rand(), true ) ) . '.jpg';

            //Insertar los datos si no hay campos vacios
            if(empty($errores)){

                //Resize a la imagen subida
                if($_FILES['propiedad']['tmp_name']['imagen']){

                    $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                    $propiedad->setImagen($nombreImagen);
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                
                //Guardar la propiedad
                $propiedad->guardar();
            }
            
        }

        //Asignar la vista que se va a renderizar y un array con datos que se van a pasar hacia la vista
        $router->render('propiedades/actualizar', [
            'errores' => $errores,
            'propiedad' => $propiedad,
            'vendedores' => $vendedores
        ]);
    }

    public static function eliminar(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
    
            if($id){
    
                $tipo = $_POST['tipo'];
    
                if(validarTipoContenido($tipo)){
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
    
        }
    }
}