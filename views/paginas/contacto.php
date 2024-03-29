<main class="contenedor seccion">
        <h1>Contacto</h1>

        <?php
            if($mensaje){ ?>
                <p class='alerta exito'> <?php echo $mensaje; ?> </p>
        <?php    } ?>
        
        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="imagen formulario">
        </picture>

        <h2>Llene el formulacio de contacto</h2>
        <form class="formulario" action="/contacto" method="POST">
            <fieldset>
                <legend>Informacion personal</legend>
                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Ejemplo: Pepito Perez" id="nombre" name="contacto[nombre]" required>



                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" name="contacto[mensaje]" required></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion sobre la propiedad de interes</legend>

                <label for="opciones">Vende o Compra</label>
                <select id="opciones" name="contacto[tipo]" required>
                    <option value="" disabled selected>--Seleccione--</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Venta</option>
                </select>

                <label for="presupuesto">Precio o Presupuesto</label>
                <input type="number" placeholder="Ejemplo: 2,540.000.000" id="presupuesto" name="contacto[precio]" required>
                
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>

                <p>Como desea ser contactado</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Telefono</label>
                    <input type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]" required>

                    <label for="contactar-email">E-mail</label>
                    <input type="radio" value="email" id="contactar-telefono" name="contacto[contacto]" required>
                </div>

                <div id="contacto"></div>


            </fieldset>

            <input type="submit" value="Enviar" class="boton-verblog">

        </form>
    </main>