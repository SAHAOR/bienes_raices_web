<?php

//proceso inicio de sesion
require '../../includes/app.php';

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

estaAutenticado();

$propiedad = new Propiedad;

//consulta para poner todos los vendedores
$vendedores= Vendedor::all();


//arrego con mshjs de errores
$errores = Propiedad::getErrores();

//ejecutar codigo luego que usuario envia formulario
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $propiedad = new Propiedad($_POST['propiedad']);


    //crear carpeta
    $carpetaImagenes = '../../imagenes/';


    if(!is_dir($carpetaImagenes) ){
        mkdir($carpetaImagenes);
        }
    
    //generar nombre unico para las imagenes subidas
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    //setear la imagen
    //realiza un resize a la imagen con intervention

    if($_FILES['propiedad']['tmp_name']['imagen']){
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
        $propiedad->setImagen($nombreImagen);
    }


    $errores = $propiedad->validar();


    if(empty($errores)){

        if(!is_dir(CARPETA_IMAGENES)){
            mkdir(CARPETA_IMAGENES);
        }

        //guardar la imagen en el servidor
        $image->save(CARPETA_IMAGENES . $nombreImagen);

        $propiedad->guardar();

    }

}

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>
        <a href="/admin" class="boton boton-amarillo">Volver</a>

        <?php foreach($errores as $error) : ?>
            <div class="alerta error">
            <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

    <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype= "multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php' ?>

        <input type="submit" value="crear propiedad" class="boton boton-vertodo">
    </form>

    </main>

    <?php
    incluirTemplate('footer');
?>