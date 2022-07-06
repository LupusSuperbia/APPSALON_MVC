<?php

namespace Controllers;

use MVC\Router;


class CitaController
{
    public static function index(Router $router)
    {
        // $nombre = $_GET["nombre"];
       

        // if (!$nombre) {
        //     header('Location: /');
        // }
        // debuguear($_SESSION);
        
        // session_start()

        isAuth();
        
        $router->render('cita/index', [
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id']
        ]);
    }
}
