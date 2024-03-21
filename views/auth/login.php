<main class="contenedor seccion">
        <h1>Iniciar Sesion</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario iniciar-sesion" action="/login">
            <fieldset>
                <legend>Correo y Clave</legend>
                
                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Ejemplo: pepe@correo.com" id="email" required>

                <label for="password">Clave</label>
                <input type="password" name="password" placeholder="Tu clave" id="password" required>

            </fieldset>

            <input type="submit" value="Iniciar Sesion" class="boton boton-iniciarsesion">
        </form>
    </main>