<?php

    require 'includes/funciones.php';
    incluirTemplate('header', $inicio = true);
?>

    <main class="contenedor seccion">
        <h1>Conocenos mas</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Curabitur ligula ex, blandit et velit eu, tincidunt pretium felis. Duis fringilla purus elit, ut efficitur lorem viverra id.</p>
            </div>

            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy">
                <h3>Seguridad</h3>
                <p>Curabitur ligula ex, blandit et velit eu, tincidunt pretium felis. Duis fringilla purus elit, ut efficitur lorem viverra id.</p>
            </div>

            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy">
                <h3>Seguridad</h3>
                <p>Curabitur ligula ex, blandit et velit eu, tincidunt pretium felis. Duis fringilla purus elit, ut efficitur lorem viverra id.</p>
            </div>
        </div>
    </main>

    <section class="seccion contenedor">
        <h2>Casas y Apartamentos en Venta</h2>

        <?php
            $limite =3;
            include 'includes/templates/anuncios.php';
        ?>

        <div class="ver-todas">
            <a href="anuncios.php" class="boton boton-vertodo">Ver Todas</a>
        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Dejanos asesorarte</h2>
        <p>Agenda una cita y deja que un asesor responda todas tus inquietudes</p>
        <a href="contacto.php" class="boton-vertodo">Agendar cita</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="imagen/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jpg">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="Texto entrada blog">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p class="informacion-meta">Escrito el: <span>20/10/202#</span> por <span>Admin</span></p>
                        <p>Consejos para construir una terraza en el techo de tu casa con los  mejores materiales y ahorrando dinero</p>
                    </a>
                </div>
            </article>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="imagen/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jpg">
                        <img loading="lazy" src="build/img/blog2.jpg" alt="Texto entrada blog">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Guia para la decoracion de tu hogar</h4>
                        <p class="informacion-meta">Escrito el: <span>20/10/202#</span> por <span>Admin</span></p>
                        <p>Minimiza el espacio en tu hogar con esta guia, aprende a combinar muebles y colores para darle vida a tu espacio</p>
                    </a>
                </div>
            </article>

            <div class="ver-todas">
                <a href="blog.php" class="boton boton-verblog">Ver todas las entradas</a>
            </div>
        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <blockquote>
                    El personal se comporo de una excelente forma, muy buena atencion y la casa que me ofrecieron cumple con todas mis expectativas.
                </blockquote>
                <p>Samir Hassan</p>
            </div>

        </section>
    </div>

<?php
    incluirTemplate('footer');
?>