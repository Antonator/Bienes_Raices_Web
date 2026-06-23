<?php 
    require 'includes/funciones.php';
    
    incluirTemplate('header');

?>

    <main class="contenedor seccion">
        <h1>Contacto</h1>

        <picture>
            <source src="build/img/destacada3.webp" type="image/webp">
            <source src="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="imagen contacto">
        </picture>

        <h2>Llene el formulario de contacto</h2>

        <form action="" class="formulario">
            <fieldset>
                <legend>Información personal</legend>

                <label for="nombre">Nombre</label>
                <input placeholder="Tu Nombre" type="text" name="" id="nombre">

                <label for="email">Email</label>
                <input placeholder="Tu Email" type="email" name="" id="email">

                
                <label for="Teléfono">Teléfono</label>
                <input placeholder="Tu Teléfono" type="tel" name="" id="Teléfono">

                <label for="Mensaje">Mensaje:</label>
                <textarea name="" id="Mensaje"></textarea>

            </fieldset>

            <fieldset>
                <legend>Información sobre la propiedad</legend>

                <label for="opciones">Vende o compra</label>
                <select name="" id="opciones">
                    <option value="" disabled selected></option>
                    <option value="Compra">Compra</option>
                    <option value="Venta">Venta</option>
                </select>

                <label for="presupuesto">Precio o presupuesto</label>
                <input placeholder="Tu precio o presupuesto" type="number" name="" id="presupuesto">

            </fieldset>

            <fieldset>
                <legend>Contacto</legend>
                <p>¿Cómo desea ser contactado?</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input type="radio" value="telefono" name="contacto" id="contactar-telefono">

                    <label for="contactar-email">Email</label>
                    <input type="radio" value="email" name="contacto" id="contactar-email">
                </div>

                <p>Si eligió teléfono elija fecha y hora para ser contactado</p>
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha">

                <label for="hora">Hora</label>
                <input type="time" id="hora" min="09:00" max="18:00">

            </fieldset>
            <input type="submit" value="Enviar" class="boton-verde">
        </form>

    </main>

    <?php 
    require 'includes/funciones.php';
    
    incluirTemplate('footer');

    ?>

    <script src="build/js/bundle.min.js"></script>
</body>
</html>