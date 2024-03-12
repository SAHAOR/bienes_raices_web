<?php

    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Contacto</h1>
        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="imagen formulario">
        </picture>

        <h2>Llene el formulacio de contacto</h2>
        <form class="formulario">
            <fieldset>
                <legend>Informacion personal</legend>
                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Ejemplo: Pepito Perez" id="nombre">

                <label for="email">E-mail</label>
                <input type="email" placeholder="Ejemplo: pepe@correo.com" id="email">

                <label for="telefono">Telefono</label>
                <input type="tel" placeholder="Ejemplo: 123456679" id="telefono">

                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje"></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion sobre la propiedad de interes</legend>

                <label for="opciones">Vende o Compra</label>
                <select id="opciones">
                    <option value="" disabled selected>--Seleccione--</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Venta</option>
                </select>

                <label for="presupuesto">Precio o Presupuesto</label>
                <input type="number" placeholder="Ejemplo: 2,540.000.000" id="presupuesto">
                
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>

                <p>Como desea ser contactado</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Telefono</label>
                    <input name="contacto" type="radio" value="telefono" id="contactar-telefono">

                    <label for="contactar-email">E-mail</label>
                    <input name="contacto" type="radio" value="email" id="contactar-telefono">
                </div>

                <p>Si eligio telefono, elija la fecha y hora para ser contactado</p>

                <label for="fecha">Fecha</label>
                <input type="date" id="fecha">

                <label for="hora">Hora</label>
                <input type="time" id="hora" min="09:00" max="16:00">
            </fieldset>

            <input type="submit" value="Enviar" class="boton-verblog">

        </form>
    </main>

    <?php
    incluirTemplate('footer');
?>