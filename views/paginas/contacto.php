<main class="contenedor seccion">
    <h1 data-cy="heading-contacto">Contacto</h1>

    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="Formulario Contacto">
    </picture>

    <h2 data-cy="heading-formulario">Llene el Formulario de Contacto</h2>

    <?php if($mensaje): ?>
        <p data-cy="mensaje-contacto" class="alerta exito"><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <form data-cy="formulario-contacto" class="formulario" method="POST" action="/contacto">
        <fieldset>
            <legend>Información Personal</legend>
            <label for="nombre">Nombre</label>
            <input data-cy="input-nombre" type="text" placeholder="Tu Nombre" id="nombre" name="contacto[nombre]" required>

            <label for="mensaje">Mensaje</label>
            <textarea data-cy="input-mensaje" id="mensaje" name="contacto[mensaje]" required></textarea>
        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>
            <label for="opciones">Vende o Compra:</label>
            <select data-cy="input-opciones" id="opciones" name="contacto[opciones]" required>
                <option value="" disabled selected>--Seleccione--</option>
                <option value="compra">Compra</option>
                <option value="vende">Vende</option>
            </select>

            <label for="presupuesto">Precio o Presupuesto:</label>
            <input data-cy="input-precio" type="number" name="contacto[precio]" placeholder="Tu precio o Presupuesto" id="presupuesto" min="0" required>
        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>
            <p>¿Cómo desea ser contactado?</p>
            
            <div class="forma-contacto">
                <div>
                    <label for="telefono">Teléfono</label>
                    <input data-cy="input-contacto" type="radio" name="contacto[contacto]" value="telefono" id="contactar-telefono">
                </div>
                <div>
                    <label for="email">E-mail</label>
                    <input data-cy="input-contacto" type="radio" name="contacto[contacto]" value="email" id="contactar-email">
                </div>
            </div>

            <div id="contacto"></div>

            
        </fieldset>
        
        <input data-cy="enviar-email" type="submit" class="boton-verde">
    </form>

</main>