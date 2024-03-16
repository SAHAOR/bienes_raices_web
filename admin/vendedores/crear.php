<?php

require '../../includes/app.php';
use App\Vendedor;

estaAutenticado();

$vendedor = new Vendedor;

//arrego con mshjs de errores
$errores = Vendedor::getErrores();

//ejecutar codigo luego que usuario envia formulario
if($_SERVER['REQUEST_METHOD'] === 'POST'){

//instanciar vendedor
    $vendedor = new Vendedor($_POST['vendedor']);

    $errores = $vendedor->validar();

    if(empty($errores)){
        $vendedor->guardar();
    }
}






incluirTemplate('header');

?>

<main class="contenedor seccion">
        <h1>Registrar Vendedor(a)</h1>
        <a href="/admin" class="boton boton-amarillo">Volver</a>

        <?php foreach($errores as $error) : ?>
            <div class="alerta error">
            <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

    <form class="formulario" method="POST" action="/admin/vendedores/crear.php">
        <?php include '../../includes/templates/formulario_vendedores.php' ?>

        <input type="submit" value="Registrar Vendedor(a)" class="boton boton-vertodo">
    </form>

    </main>

    <?php
    incluirTemplate('footer');
?>