<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{
    public static function index(Router $router){

        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }
    public static function nosotros(Router $router){
        $router->render('paginas/nosotros',[

        ]);
    }
    public static function propiedades(Router $router){

        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades',[
            'propiedades' => $propiedades
        ]);
    }
    public static function propiedad(Router $router){

        $id = Redireccionar('/propiedades');

        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad',[
            'propiedad' => $propiedad
        ]);
    }
    public static function blog(Router $router){
        $router->render('paginas/blog',[

        ]);
    }
    public static function entrada(Router $router){
        $router->render('paginas/entrada',[

        ]);
    }
    public static function contacto(Router $router){

        $mensaje = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){


            $respuestas = $_POST['contacto'];

            //Crear una instancia de php mailer
            $mail = new PHPMailer();
            //configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '2e42ad737464d8';
            $mail->Password = '7cbfadb85c1f64';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            //Configurar el contenido del email
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un nuevo mensaje';

            //habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //definir contenido y enviar de forma condicional segun seleccion

            $contenido = '<html>';
            $contenido .=  '<p>Tienes un nuevo mensaje</p>';
            $contenido .=  '<p>Nombre: '. $respuestas["nombre"] . '</p>'; 

            if($respuestas["contacto"] === 'telefono'){
                $contenido .= '<p>Eligio ser contactado por telefono </p>';
                $contenido .=  '<p>Telefono: '. $respuestas["telefono"] . '</p>';
                $contenido .=  '<p>Fecha: '. $respuestas["fecha"] . '</p>';
                $contenido .=  '<p>Hora: '. $respuestas["hora"] . '</p>';
            } else{
                $contenido .= '<p>Eligio ser contactado por email </p>';
                $contenido .=  '<p>Email: '. $respuestas["email"] . '</p>';
            }

            $contenido .=  '<p>Mensaje: '. $respuestas["mensaje"] . '</p>';
            $contenido .=  '<p>Objetivo: '. $respuestas["tipo"] . '</p>';
            $contenido .=  '<p>Presupuesto: $'. $respuestas["precio"] . '</p>';
            $contenido .=  '<p>Contactar mediante: '. $respuestas["contacto"] . '</p>';

            $contenido .= '</html>'; 

            $mail->Body = $contenido;
            $mail->AltBody = 'texto al ternativo a html';

            //enviar el email
            if($mail->send()){
                $mensaje = 'mensaje enviado correctamente';
            }
            else{
                $mensaje = 'el mensaje no se pudo enviar';
            }
        }

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}