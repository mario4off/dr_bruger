<div class="col-12 col-md-5 d-flex flex-column align-items-center p-3 mt-sm-4">
    <?php
    if (isset($_GET['warning']) && $_GET['warning'] == 'not_exist_user') {

        ?>
        <div class="warning mb-4 w-100 text-center">
            <p class="m-2">EL USUARIO NO EXISTE</p>
            <p class="m-2">Las credenciales introducidas no se corresponden con las de ningún usuario registrado</p>
        </div>

        <?php
    } elseif (isset($_GET['warning']) && $_GET['warning'] == 'wrong_password') {
        ?>
        <div class="warning mb-4 w-100 text-center">
            <p class="m-2"><strong>LA CONTRASEÑA NO ES CORRECTA</strong></p>
            <p class="m-2">Por favor, introduce la contraseña asociada a esta cuenta.</p>
        </div>

    <?php } ?>
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