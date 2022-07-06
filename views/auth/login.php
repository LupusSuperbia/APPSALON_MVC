<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>

<?php include_once __DIR__ . "/../templates/alertas.php"; ?>

<!----------------- FORMULARIO ------------------>

<form class="formulario" action="/" method="POST">
    <div class="campo">
        <label for="email">Email: </label>
        <input type="email"
        id="email"
        placeholder="Tú Email"
        name="email"
        
        />
    </div>

    <div class="campo">
        <label for="password">Password: </label>
        <input type="password"
        id="password"
        placeholder="Tú Password"
        name="password"
        />
    </div>

    <input type="Submit" class="boton" value="Iniciar Sesión">

</form>

<div class="acciones">
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crear Una</a>
    <a href="/olvide">¿Olvidaste tú Password?</a>
</div>