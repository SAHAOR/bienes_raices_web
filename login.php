<?php

    require 'includes/app.php';
    $db = conectarDB();

    $errores= [];

    //autenticar el usuario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email =mysqli_real_escape_string($db, filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL));
        $password =mysqli_real_escape_string($db, $_POST['password']);

        if(!$email){
            $errores[] = "El email es obligatorio o no es valido";
        }

        if(!$password){
            $errores[] = "La clave es obligatoria";
        }

        if(empty($errores)){
            //revisar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '$email'";
            $resultado = mysqli_query($db, $query);

            if($resultado->num_rows){
                //revisar si password es correcto
                $usuario = mysqli_fetch_assoc($resultado);
                //verificar si el password es correcto
                $auth= password_verify($password, $usuario['password']);

                if($auth){
                    //el usuario esta autenticado
                    session_start();

                    //llenar el arreglo de la sesion
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    header('Location: /admin');

                }else{
                    $errores[] ='La clave es incorrecta';
                }
            }
            else{
                $errores[] = "El usuario no existe";
            }

        }
    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Iniciar Sesion</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario iniciar-sesion">
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

    <?php
    incluirTemplate('footer');
?>