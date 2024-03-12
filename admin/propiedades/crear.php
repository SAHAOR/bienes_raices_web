<?php

//proceso inicio de sesion
require '../../includes/funciones.php';
$auth = estaAutenticado();
if (!$auth){
    header('Location: /');
}


require '../../includes/config/database.php';
$db = conectarDB();

//consultar
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

//arrego con mshjs de errores
$errores = [];

$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorId = '';

//ejecutar codigo luego que usuario envia formulario
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    //datos sanitizados con esa funcion (evitar inyecciones sql)
    $titulo = mysqli_real_escape_string( $db, $_POST['titulo']);
    $precio = mysqli_real_escape_string( $db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string( $db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string( $db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string( $db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string( $db, $_POST['estacionamiento']);
    $vendedorId = mysqli_real_escape_string( $db, $_POST['vendedor']);
    $creado = date('Y/m/d');

    //asignar files a una variable
    $imagen = $_FILES['imagen'];

    if(!$titulo){
        $errores[] = "Debes agregar un titulo";
    }
    if(!$precio || $precio > 99999999.99){
        $errores[] = "El precio es obligatorio y debe tener menos de 10 digitos";
    }
    if(strlen($descripcion) <50 ){
        $errores[] = "La descripcion es obligatoria y debe tener al menos 50 caracteres";
    }
    if(!$habitaciones){
        $errores[] = "El numero de habitaciones es obligatorio";
    }
    if(!$wc){
        $errores[] = "El numero de ba;os es obligatorio";
    }
    if(!$estacionamiento){
        $errores[] = "El numero de estacionamientos es obligatorio";
    }
    if(!$vendedorId){
        $errores[] = "Elige un vendedor";
    }
    if(!$imagen['name'] || $imagen['error']){
        $errores[] = "La imagen es obligatoria";
    }
    
    //validar por tamano
    $medida = 1000 * 1000;
    if($imagen['size'] > $medida){
        $errores[] = "La imagen no debe ser superior a 100kb";
    }


    // echo "<pre>";
    // var_dump($errores);
    // echo "<pre>";

    //revisar si arreglo de errores esta vacio para realizar insercion
    if(empty($errores)){

        //subida de archivos al servidor
        //crear carpeta
        $carpetaImagenes = '../../imagenes/';

        if(!is_dir($carpetaImagenes) ){
        mkdir($carpetaImagenes);
        }

        //generar nombre unico para las imagenes subidas
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        //subir la imagen
        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
        
        
        //insertar en la base de datos
        $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedores_id) VALUES ('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedorId' )";

        $resultado = mysqli_query($db, $query);

        if($resultado){
            //redireccionar al usuario una vez enviado correctamente
            //aparte hacer un query string (url con parametros)
            header('Location: /admin?resultado=1');
        }
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
        <fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo propiedad" value="<?php echo $titulo; ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio propiedad" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

            <label for="descripcion">Descripcion</label>
            <textarea id="descripcion" name="descripcion"> <?php echo $descripcion; ?> </textarea>
        </fieldset>

        <fieldset>
            <legend>Informacion Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

            <label for="wc">Banos:</label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc; ?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento; ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedor">
                <option value="" disabled selected>--Seleccione--</option>
                <?php while ($vendedor = mysqli_fetch_assoc($resultado)): ?>
                    <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id']; ?>"><?php echo $vendedor['nombre']. " " . $vendedor['apellido'] ?></option>
                <?php endwhile; ?>
            </select>
        </fieldset>

        <input type="submit" value="crear propiedad" class="boton boton-vertodo">
    </form>

    </main>

    <?php
    incluirTemplate('footer');
?>