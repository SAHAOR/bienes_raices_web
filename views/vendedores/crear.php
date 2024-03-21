<main class="contenedor seccion">
        <h1>Registrar Vendedor(a)</h1>
        <a href="/admin" class="boton boton-amarillo">Volver</a>

        <?php foreach($errores as $error) : ?>
            <div class="alerta error">
            <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

    <form class="formulario" method="POST" action="/vendedores/crear">
        <?php include 'formulario.php' ?>

        <input type="submit" value="Registrar Vendedor(a)" class="boton boton-vertodo">
    </form>

    </main>