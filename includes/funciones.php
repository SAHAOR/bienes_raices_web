<?php

define('TEMPLATES_URL', __DIR__ .  '/templates');
define('FUNCIONES_URL', __DIR__ .  'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

function incluirTemplate(string $nombre, bool $inicio = false){
    include TEMPLATES_URL  . '/' . $nombre. '.php';
}

function estaAutenticado() : bool {
        //sesion de usuario lista
        session_start();

    
        if(!$_SESSION['login']){
            return false;
            header('Location: /');
        }

        if($_SESSION['login']){
            return true;
            header('Location: /admin');
        }
        
        return false;
}

function debuguear($variable){
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
}

function sanitizar($html) :string {
    $sanitizar = htmlspecialchars($html);
    return $sanitizar;
}

//validar tipo de contenido
function validarTipoContenido($tipo){
    $tipos = ['vendedor', 'propiedad'];

    return in_array($tipo, $tipos);
}

//muestra las alertas 
function mostrarNotificacion(int $codigo){
    $mensaje = '';

    switch($codigo) {
        case 1:
            $mensaje = 'Creado correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado correctamente';
            break;

        default:
            $mensaje = false;
            break;

    }
    return $mensaje;

}

function Redireccionar(string $url){
    //proceso actualizar
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header("Location: $url");
    }

    return $id;
}