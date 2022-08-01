<?php

namespace Controller;

use Model\Propiedad;
use MVC\Router;
use PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\PHPMailer as PHPMailerPHPMailer;

class PaginasController{

    public static function index(Router $router){
        
        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router->render('/paginas/index', [
            'inicio' => $inicio,
            'propiedades' => $propiedades
        ]);
    }

    public static function nosotros(Router $router){
        $router->render('paginas/nosotros');
    }

    public static function propiedades(Router $router){

        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad(Router $router){

        $id = validarORedireccionar('/admin');

        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }

    public static function blog(Router $router){
        $router->render('paginas/blog');
    }

    public static function entrada(Router $router){
        $router->render('paginas/entrada');
    }

    public static function contacto(Router $router){

        $mensaje = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){


            $respuestas = $_POST['contacto'];

            //Crear una instancia de PHPMailer
            $mail = new PHPMailerPHPMailer();

            //Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '3dd44fced6583d';
            $mail->Password = '11aa33d4cd88bc';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            //Configurar contenido del email
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un nuevo mensaje';

            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //Definir el contenido
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . '</p>';

            if($respuestas['contacto'] === 'telefono'){

                $contenido .= '<p>Prefiere ser contactado por: ' . $respuestas['contacto'] . '</p>';
                $contenido .= '<p> Hora y Fecha de la llamada </p>';
                $contenido .= '<p>Teléfono: ' . $respuestas['telefono'] . '</p>';
                $contenido .= '<p>fecha: ' . $respuestas['fecha'] . '</p>';
                $contenido .= '<p>hora: ' . $respuestas['hora'] . '</p>';
            }else {

                $contenido .= '<p>Prefiere ser contactado por: ' . $respuestas['contacto'] . '</p>';
                $contenido .= '<p>Email: ' . $respuestas['email'] . '</p>';
            }
            
            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>';
            $contenido .= '<p>Vende o compra: ' . $respuestas['opciones'] . '</p>';
            $contenido .= '<p>Precio o presupuesto: $' . $respuestas['precio'] . '</p>';
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin HTML';

            //Enviar el email
            if($mail->send()){
                $mensaje = 'Mensaje Enviado';
            }else {
                $mensaje = 'No se pudo enviar el mensaje';
            }
        }
        
        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}