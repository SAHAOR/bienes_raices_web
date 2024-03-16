<fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Nombre:</label>
            <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre" value="<?php echo sanitizar($vendedor->nombre); ?>">

            <label for="titulo">Apellido:</label>
            <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido(s)" value="<?php echo sanitizar($vendedor->apellido); ?>">

        
</fieldset>

<fieldset>
    <legend>Informacion Extra</legend>

    <label for="titulo">Telefono:</label>
    <input type="text" id="telefono" name="vendedor[telefono]" placeholder="Telefono" value="<?php echo sanitizar($vendedor->telefono); ?>">

</fieldset>

        