<?php

//proceso inicio de sesion

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

require '../../includes/app.php';

estaAutenticado();

//proceso actualizar
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    header('Location: /admin');
}


//consultar para obtener datos de la propiedad
$propiedad = Propiedad::find($id);

//consultar para obtener vendedores
$vendedores = Vendedor::all();

//arrego con mshjs de errores
$errores = Propiedad::getErrores();


//ejecutar codigo luego que usuario envia formulario
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    //asignar atributos
    $args =$_POST['propiedad'];

    $propiedad->sincronizar($args);
    
    //validacion
    $errores = $propiedad->validar();

    //generar nombre unico para las imagenes subidas
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    //subida de archivos
    if($_FILES['propiedad']['tmp_name']['imagen']){
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
        $propiedad->setImagen($nombreImagen);
    }

    //revisar si arreglo de errores esta vacio para realizar insercion
    if(empty($errores)){
        if($_FILES['propiedad']['tmp_name']['imagen']){
        //almacenbar la imagen en HDD
            $image->save(CARPETA_IMAGENES . $nombreImagen);
        }

        $propiedad->guardar();        
 
    }

}







    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Actualizar</h1>
        <a href="/admin" class="boton boton-amarillo">Volver</a>

        <?php foreach($errores as $error) : ?>
            <div class="alerta error">
            <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

    <form class="formulario" method="POST" enctype= "multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>

        <input type="submit" value="Actualizar propiedad" class="boton boton-vertodo">
    </form>

    </main>

    <?php
    incluirTemplate('footer');
?>