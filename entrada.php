<?php

    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Guia para la decoracion de tu hogar</h1>
        <p class="informacion-meta">Escrito el: <span>20/10/202#</span> por: <span>Admin</span></p>
        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpg">
            <img loading="lazy" src="build/img/destacada2.jpg" alt="imagen propiedad">
        </picture>

        <p>
            Curabitur sem tellus, malesuada eu finibus quis, bibendum fermentum purus. Nunc id imperdiet tellus. Donec ac ipsum facilisis augue tincidunt scelerisque. Praesent convallis lectus eget ante varius euismod. Curabitur suscipit ante mi, sed pellentesque quam ultrices vel. Aenean eget ultrices magna, ut convallis ante. Etiam euismod, mauris et semper pharetra, enim magna aliquet magna, a pulvinar mi neque convallis lorem. Vivamus condimentum lacus ac metus bibendum imperdiet. Proin posuere sodales urna sit amet elementum. Quisque interdum, lacus a finibus suscipit, arcu urna suscipit mi, ut elementum nulla quam sed enim. Nunc suscipit bibendum massa non accumsan. Aliquam augue sapien, pellentesque sed ullamcorper a, rhoncus vel nulla. Suspendisse volutpat libero diam. Proin rutrum faucibus ultrices. Proin non mollis eros. Phasellus at elementum urna.
        </p>
    </main>

    <?php
    incluirTemplate('footer');
?>