<?php
    //importar la bd
    require 'includes/config/database.php';
    $db =conectarDB();
    //consultar
    $query = "SELECT * FROM propiedades LIMIT $limite";
    //obtener resultado
    $resultado = mysqli_query($db, $query);



?>
<div class="contenedor-anuncios">
    <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
            <div class="anuncio" onclick="window.location.href='anuncio.php?id=<?php echo $propiedad['id']; ?>'">

                <img loading="lazy" src="imagenes/<?php echo $propiedad['imagen']; ?>" alt="anuncio">
                
                <div class="contenido-anuncio">
                    <h3><?php echo $propiedad['titulo']; ?></h3>
                    <p><?php echo $propiedad['descripcion']; ?></p>
                    <p class="precio">$<?php echo $propiedad['precio']; ?> COP</p>

                    <ul class="iconos-caracteristicas">
                        <li>
                            <img class="iconoP" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                            <p><?php echo $propiedad['wc']; ?></p>
                        </li>
                        <li>
                            <img class="iconoP" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono wc">
                            <p><?php echo $propiedad['estacionamiento']; ?></p>
                        </li>
                        <li>
                            <img class="iconoP" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono wc">
                            <p><?php echo $propiedad['habitaciones']; ?></p>
                        </li>
                    </ul>
                    <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class="boton boton-amarillo">
                        Ver Propiedad
                    </a>
                </div>
            </div>
    <?php endwhile; ?>
</div>

<?php
    //cerrar la conexion
    mysqli_close($db);
?>