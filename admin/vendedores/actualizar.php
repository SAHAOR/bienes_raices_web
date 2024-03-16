<?php

require '../../includes/app.php';
use App\Vendedor;

estaAutenticado();

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    header('Location: /admin');
}

//obtener arreglo de vendedor
$vendedor = Vendedor::find($id);

//arrego con mshjs de errores
$errores = Vendedor::getErrores();

//ejecutar codigo luego que usuario envia formulario
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    //asignar los valores
    $args = $_POST['vendedor'];

    //sincronizar objeto en memoria con lo que usuario escribio
    $vendedor->sincronizar($args);

    //validacion
    $errores = $vendedor->validar();

    if(empty($errores)){
        $vendedor->guardar();
    }

    debuguear($vendedor);


}

incluirTemplate('header');

?>

<main class="contenedor seccion">
        <h1>Actualizar Vendedor(a)</h1>
        <a href="/admin" class="boton boton-amarillo">Volver</a>

        <?php foreach($errores as $error) : ?>
            <div class="alerta error">
            <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

    <form class="formulario" method="POST">
        <?php include '../../includes/templates/formulario_vendedores.php' ?>

        <input type="submit" value="Actualizar Informacion" class="boton boton-vertodo">
    </form>

    </main>

    <?php
    incluirTemplate('footer');
?>