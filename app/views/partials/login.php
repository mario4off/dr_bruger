<div class="col-12 col-md-5 d-flex flex-column align-items-center p-3 mt-sm-4">
    <h2><?= $_GET['action'] == 'showUser' ? 'CLIENTE REGISTRADO' : '¿TIENES UNA CUENTA?' ?>
    </h2>
    <p class="p-user-page mb-2 mt-1">
        <?= $_GET['action'] == 'showUser' ? '¿Ya tienes una cuenta? Inicia sesión.' : 'Inicia sesión para finalizar tu pedido' ?>
    </p>
    <form class="d-flex flex-column w-100" action="?controller=user&action=userLogin" method="POST">
        <label class="label-style" for="">Correo electrónico</label><input class="input-user mt-2 mb-3" name="mail"
            type="email" placeholder="Correo electrónico">
        <div class="d-flex justify-content-end text-decoration-underline"> <button class="rm-input-style">Mostrar
                contraseña</button></div>
        <label class="label-style" for="">Contraseña</label><input class="input-user mt-2 mb-3" name="pwd"
            type="password" placeholder="Contraseña">
        <a class="text-decoration-underline text-reset" href="">¿Has olvidado tu contraseña?</a>
        <input class="rm-input-style text-center p-2 rm-input-style input-submit text-center mt-4 p-2" type="submit"
            value="INICIAR SESION">
    </form>
</div>