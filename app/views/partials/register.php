<div class="col-12 col-md-5 d-flex flex-column align-items-center mt-sm-4 p-3">
    <!-- A través de la variable GET warning, success y error se muestran en diferentes partes mensajes que
     enuncian avisos en relación a errores con el proceso de registro-->
    <?php
    if (isset($_GET['warning']) && $_GET['warning'] == 'user_exist') {

        ?>
        <div class="warning mb-4 w-100 text-center">
            <p class="m-2"><strong>EL USUARIO YA ESTÁ REGISTRADO</strong></p>
            <p class="m-2">Los datos de usuario introducidos pertenenecen a un usuario ya registrado.</p>
        </div>

        <?php
    } elseif (isset($_GET['warning']) && $_GET['warning'] == 'mail_format') {
        ?>
        <div class="warning mb-4 w-100 text-center">
            <p class="m-2"><strong>EL FORMATO DEL CORREO ELECTRÓNICO NO ES VÁLIDO</strong></p>
            <p class="m-2">Por favor, vuelve a introducir el correo electrónico con un formato válido.</p>
        </div>

    <?php } elseif (isset($_GET['warning']) && $_GET['warning'] == 'missmatch_password') {
        ?>
        <div class="warning mb-4 w-100 text-center">
            <p class="m-2"><strong>LAS CONTRASEÑAS INTRODUCIDAS NO COINCIDEN</strong></p>
            <p class="m-2">Por favor, vuelve a introducir las contraseñas de forma coincidente con el formato requerido.</p>
        </div>

    <?php } elseif (isset($_GET['success']) && $_GET['success'] == 'user_created') {
        ?>
        <div class="success mb-4 w-100 text-center">
            <p class="m-2"><strong>USUARIO REGISTRADO CON ÉXITO</strong></p>
            <p class="m-2">Por favor, inicia sesión para comenzar tus compras.</p>
        </div>

    <?php } ?>
    <h2>CLIENTE NUEVO</h2>
    <div class="w-100 d-flex justify-content-start mt-1">
        <p class="p-user-page ">Crea una cuenta para finalizar tus compras más
            rápidamente.</p>
    </div>
    <!-- Se configuran los inputs por tipo en función de texto, mail o número y se establecen patrones, campos obligatorios 
     para poder hacer el registro -->
    <form class="d-flex flex-column w-100" action="?controller=user&action=createUser" method="POST">
        <label class="label-style " for="">Nombre</label><input class="input-user mt-3 mb-3" name="name" type="text"
            placeholder="Nombre" required>
        <label class="label-style" for="">Apellidos</label><input class="input-user mt-2 mb-3" name="lastname"
            type="text" placeholder="Apellidos" required>
        <label class="label-style" for="">Teléfono móvil</label><input class="input-user mt-2 mb-3" name="phone"
            type="text" placeholder="Teléfono móvil" required>
        <label class="label-style" for="">Dirección</label><input class="input-user mt-2 mb-3" name="address"
            type="text" placeholder="Dirección completa" required>
        <label class="label-style" for="">Población</label><input class="input-user mt-2 mb-3" name="city" type="text"
            placeholder="Población" required>
        <label class="label-style" for="">Código Postal</label><input class="input-user mt-2 mb-3" name="cp" type="text"
            placeholder="Código Postal" required>
        <label class="label-style" for="">Correo electrónico</label><input class="input-user mt-2 mb-3" name="mail"
            type="email" placeholder="Correo electrónico" required>
        <div class="d-flex justify-content-end"> <button class="rm-input-style text-decoration-underline">Mostrar
                contraseña</button></div>
        <label class="label-style" for="">Contraseña</label><input class="input-user mt-2 mb-3" name="pwd"
            type="password" placeholder="Contraseña" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}" required>
        <label class="label-style" for="">Repite la contraseña</label><input class="input-user mt-2 mb-1" name="pwd-r"
            type="password" placeholder="Vuelve a introducir la contraseña"
            pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}" required>
        <div class="container m-2">
            <p class="user-page-p">Mínimo <strong>8 carácteres</strong> que incluyan:</p>
            <div class="d-flex flex-wrap justify-content-between ">
                <p class="me-4 user-page-p">1 letra <strong>mayúscula</strong></p>
                <p class="me-4 user-page-p">1 letra <strong>minúscula</strong></p>
                <p class="me-4 user-page-p">1 <strong>número</strong></p>
                <p class="me-4 user-page-p">1 carácter <strong>especial</strong></p>
            </div>
        </div>
        <div class="d-flex mt-3 mb-3">
            <input class="checkbox-user" type="checkbox" required>
            <p class="user-page-p fw-normal">SUSCRÍBETE A LA NEWSLETTER<strong> Y CONSIGUE UN CÓDIGO CON UN -10
                    %
                    RESERVADO PARA NUEVOS
                    SUSCRIPTORES</strong> <a class="text-decoration-underline text-reset" href="">POLÍTICA DE
                    PRIVACIDAD</a></p>
        </div>
        <div class="d-flex mt-2 mb-3">
            <input class="checkbox-user" type="checkbox" required>
            <p class="user-page-p fw-normal">HE LEÍDO Y ACEPTO LOS <a class="text-decoration-underline text-reset"
                    href="">T
                    & C</a> Y LA <a class="text-decoration-underline text-reset" href="">POLÍTICA DE
                    PRIVACIDAD</a> DE DR.
                MARTENS</p>
        </div>
        <input class="rm-input-style input-submit text-center mt-3 p-2" type="submit" value="CREAR UNA CUENTA">
    </form>
</div>