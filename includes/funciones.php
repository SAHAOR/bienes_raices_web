<?php
require 'app.php';

function incluirTemplate(string $nombre, bool $inicio = false){
    include TEMPLATES_URL  . '/' . $nombre. '.php';
}

function estaAutenticado() : bool {
        //sesion de usuario lista
        session_start();

        $auth = $_SESSION['login'];
    
        if($auth){
            return true;
            header('Location: /admin');
        }
        
        return false;
}