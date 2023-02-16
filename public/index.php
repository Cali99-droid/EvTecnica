<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\UsuarioController;
use MVC\Router;

$router = new Router();


// Login

$router->get('/', [UsuarioController::class, 'suscribir']);
$router->post('/', [UsuarioController::class, 'suscribir']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

$router->get('/usuarios', [UsuarioController::class, 'usuarios']);


// Crear Cuenta
$router->get('/registro', [AuthController::class, 'registro']);
$router->post('/registro', [AuthController::class, 'registro']);

// Formulario de olvide mi password
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);

// Colocar el nuevo password
$router->get('/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/reestablecer', [AuthController::class, 'reestablecer']);

// Confirmación de Cuenta
$router->get('/mensaje', [UsuarioController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [UsuarioController::class, 'confirmar']);


$router->comprobarRutas();
