<main class="contenedor seccion contenido-centrado">
    <h1 data-cy="heading-login">Iniciar Sesión</h1>

    <?php foreach( $errores as $error ): ?>
        <div data-cy="alerta-login" class="alerta error"><?php echo $error ?></div>
    <?php endforeach; ?>

    <form data-cy="formulario-login" class="formulario" method="POST" action="/login">
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-mail</label>
            <input data-cy="input-usuario" type="email" name="usuario" placeholder="Tu Email" id="email">

            <label for="password">Teléfono</label>
            <input data-cy="input-password" type="password" name="password" placeholder="Tu Password" id="password">
            
        </fieldset>

        <input type="submit" class="boton-verde" value="Iniciar Sesión">
    </form>

</main>