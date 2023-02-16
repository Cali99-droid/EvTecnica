<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class UsuarioController
{
    public static function suscribir(Router $router)
    {
        $alertas = [];
        $usuario = new Usuario;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario->sincronizar($_POST);
            $alertas = $usuario->validar_suscripcion();

            if (empty($alertas)) {

                $existeUsuario = Usuario::where('email', $usuario->email);
                if ($existeUsuario) {
                    Usuario::setAlerta('error', '* Este email ya esta suscrito al  newsletter');
                    $alertas = Usuario::getAlertas();
                } else {

                    // Generar el Token
                    $usuario->crearToken();

                    // Crear un nuevo usuario
                    $resultado =  $usuario->guardar();

                    // Enviar email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();
                    if ($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }

        $router->render('formulario', [
            'titulo' => 'Bienvenido',
            'alertas' => $alertas,
            'usuario' => $usuario,
        ]);
    }


    public static function mensaje(Router $router)
    {

        $router->render('mensaje', [
            'titulo' => 'Suscripción Creada Exitosamente'
        ]);
    }


    public static function confirmar(Router $router)
    {

        $token = s($_GET['token']);

        if (!$token) header('Location: /');

        // Encontrar al usuario con este token
        $usuario = Usuario::where('token', $token);

        if (empty($usuario)) {
            // No se encontró un usuario con ese token
            Usuario::setAlerta('error', 'Token No Válido');
        } else {
            // Confirmar la cuenta
            $usuario->confirmado = 1;
            $usuario->token = '';
            // unset($usuario->password2);

            // Guardar en la BD
            $usuario->guardar();

            Usuario::setAlerta('exito', '! Cuenta Comprobada Correctamente ¡');
        }

        $router->render('confirmar', [
            'titulo' => 'Confirma tu cuenta ',
            'alertas' => Usuario::getAlertas()
        ]);
    }


    public static function usuarios(Router $router)
    {
        $usuarios = Usuario::all();

        $router->render('usuarios', [
            'titulo' => 'Lista de Usuarios',
            'usuarios' => $usuarios
        ]);
    }
}
