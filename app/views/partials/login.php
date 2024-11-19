<h2>CLIENTE REGISTRADO</h2>
<p class="p-user-page mb-2 mt-1">¿Ya tienes una cuenta? Inicia sesión.</p>
<form class="d-flex flex-column w-100" action="?controller=user&action=userLogin" method="POST">
    <label class="label-style" for="">Correo electrónico</label><input class="input-user mt-2 mb-3" name="mail"
        type="email" placeholder="Correo electrónico">
    <div class="d-flex justify-content-end text-decoration-underline"> <button class="rm-input-style">Mostrar
            contraseña</button></div>
    <label class="label-style" for="">Contraseña</label><input class="input-user mt-2 mb-3" name="pwd" type="password"
        placeholder="Contraseña">
    <a class="text-decoration-underline text-reset" href="">¿Has olvidado tu contraseña?</a>
    <input class="rm-input-style text-center p-2 rm-input-style input-submit text-center mt-4 p-2" type="submit"
        value="INICIAR SESION">
</form>