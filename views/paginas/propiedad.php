<main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad->titulo; ?></h1>

        <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="imagen propiedad">

        <div class="resumen-propiedad">
            <p class="precio"> $ <?php echo $propiedad->precio; ?> COP</p>
        </div>

        <ul class="iconos-caracteristicas">
            <li>
                <img class="iconoP" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad->wc; ?></p>
            </li>
            <li>
                <img class="iconoP" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono wc">
                <p><?php echo $propiedad->estacionamiento; ?></p>
            </li>
            <li>
                <img class="iconoP" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono wc">
                <p><?php echo $propiedad->habitaciones; ?></p>
            </li>
        </ul>
        <p>
            <?php echo $propiedad->descripcion; ?>
        </p>
    </main>