<div class="col-12 col-md-5 d-flex flex-column align-items-center p-3 mt-sm-4">
    <!-- A través de la variable GET warning se muestran en diferentes partes mensajes que
     enuncian avisos en relación a errores con el proceso de login-->
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
    <!-- Al ser reutilizado en el carrito este componente, en función del método se enseñan unos mensajes en el login u otro
     en la página del carrito -->
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
    <?php
    // Como este módulo es reutilizable y se utiliza también en la parte del carrito, está parte de aquí solo
    // se muestra en la página del carrito
    if ($_GET["controller"] == 'order') {
        ?>
        <div class="mb-3 d-flex w-100 align-items-center gap-3 mt-3">
            <div class="separator"></div>
            <p>O</p>
            <div class="separator"></div>
        </div>
        <a class="text-decoration-underline text-reset" href="?controller=user&action=showUser">Regístrate si aún no tienes
            una cuenta</a>
    <?php } ?>

</div>