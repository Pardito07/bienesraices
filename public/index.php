<?php

//Archivo con conexion a BD y funciones
require_once __DIR__ . '/../includes/app.php';

//Clases

use Controller\LoginController;
use MVC\Router;
use Controller\PropiedadesController;
use Controller\VendedoresController;
use Controller\PaginasController;

//Instancia del router
$router = new Router();

//Pasar URL'S hacia el router y el controller que contiene el metodo para renderizar esa URL
$router->get('/admin', [PropiedadesController::class, 'index']);
$router->get('/propiedades/crear', [PropiedadesController::class, 'crear']);
$router->post('/propiedades/crear', [PropiedadesController::class, 'crear']);
$router->get('/propiedades/actualizar', [PropiedadesController::class, 'actualizar']);
$router->post('/propiedades/actualizar', [PropiedadesController::class, 'actualizar']);
$router->post('/propiedades/eliminar', [PropiedadesController::class, 'eliminar']);

$router->get('/vendedores/crear', [VendedoresController::class, 'crear']);
$router->post('/vendedores/crear', [VendedoresController::class, 'crear']);
$router->get('/vendedores/actualizar', [VendedoresController::class, 'actualizar']);
$router->post('/vendedores/actualizar', [VendedoresController::class, 'actualizar']);
$router->post('/vendedores/eliminar', [VendedoresController::class, 'eliminar']);

$router->get('/', [PaginasController::class, 'index']);
$router->get('/nosotros', [PaginasController::class, 'nosotros']);
$router->get('/propiedades', [PaginasController::class, 'propiedades']);
$router->get('/propiedad', [PaginasController::class, 'propiedad']);
$router->get('/blog', [PaginasController::class, 'blog']);
$router->get('/entrada', [PaginasController::class, 'entrada']);
$router->get('/contacto', [PaginasController::class, 'contacto']);
$router->post('/contacto', [PaginasController::class, 'contacto']);

$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

//Validar rutas
$router->comprobarRutas();