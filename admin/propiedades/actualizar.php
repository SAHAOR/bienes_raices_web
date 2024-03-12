<?php

//proceso inicio de sesion
require '../../includes/funciones.php';
$auth = estaAutenticado();
if (!$auth){
    header('Location: /');
}


//proceso actualizar
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    header('Location: /admin');
}

require '../../includes/config/database.php';
$db = conectarDB();

//consultar para obtener datos de la propiedad
$consulta = "SELECT * FROM propiedades WHERE id=" . $id;
$resultado = mysqli_query($db, $consulta);
$propiedad = mysqli_fetch_assoc($resultado);

//consultar para obtener vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

//arrego con mshjs de errores
$errores = [];

$titulo = $propiedad['titulo'];
$precio = $propiedad['precio'];
$descripcion = $propiedad['descripcion'];
$habitaciones = $propiedad['habitaciones'];
$wc = $propiedad['wc'];
$estacionamiento = $propiedad['estacionamiento'];
$vendedorId = $propiedad['vendedores_id'];
$imagenPropiedad = $propiedad['imagen'];

//  echo "<pre>";
//  var_dump($propiedad);
//  echo "<pre>";

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
    
    //validar por tamano
    $medida = 1000 * 1000;
    if($imagen['size'] > $medida){
        $errores[] = "La imagen no debe ser superior a 100kb";
    }


    //revisar si arreglo de errores esta vacio para realizar insercion
    if(empty($errores)){

         //subida de archivos al servidor
        //crear carpeta
        $carpetaImagenes = '../../imagenes/';

        if(!is_dir($carpetaImagenes) ){
        mkdir($carpetaImagenes);
        }

        $nombreImagen = '';

        //validacion para cambiar imagen (en caso que haya nueva se borra la vieja)
        if($imagen['name']){
            unlink($carpetaImagenes . $propiedad['imagen']);

            //generar nombre unico para las imagenes subidas
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            //subir la imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
        }
        else{
            $nombreImagen = $propiedad['imagen'];
        }

        
        
        //insertar en la base de datos
        $query = "UPDATE propiedades SET titulo = '$titulo', precio = '$precio', imagen = '$nombreImagen', descripcion = '$descripcion', habitaciones = $habitaciones, wc = $wc, estacionamiento = $estacionamiento, vendedores_id = $vendedorId WHERE id = $id ";

        $resultado = mysqli_query($db, $query);

        if($resultado){
            //redireccionar al usuario una vez enviado correctamente
            //aparte hacer un query string (url con parametros)
            header('Location: /admin?resultado=2');
        }
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
        <fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo propiedad" value="<?php echo $titulo; ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio propiedad" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

            <img src="/imagenes/<?php echo $imagenPropiedad; ?>" alt="" class="imagen-actualizar">

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

        <input type="submit" value="Actualizar propiedad" class="boton boton-vertodo">
    </form>

    </main>

    <?php
    incluirTemplate('footer');
?>