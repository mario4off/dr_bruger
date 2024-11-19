<h2>CLIENTE NUEVO</h2>
<div class="w-100 d-flex justify-content-start mt-1">
    <p class="p-user-page ">Crea una cuenta para finalizar tus compras más
        rápidamente.</p>
</div>

<form class="d-flex flex-column w-100" action="?controller=user&action=createUser" method="POST">
    <label class="label-style " for="">Nombre</label><input class="input-user mt-3 mb-3" name="name" type="text"
        placeholder="Nombre" required>
    <label class="label-style" for="">Apellidos</label><input class="input-user mt-2 mb-3" name="lastname" type="text"
        placeholder="Apellidos" required>
    <label class="label-style" for="">Teléfono móvil</label><input class="input-user mt-2 mb-3" name="phone" type="text"
        placeholder="Teléfono móvil" required>
    <label class="label-style" for="">Dirección</label><input class="input-user mt-2 mb-3" name="address" type="text"
        placeholder="Dirección completa" required>
    <label class="label-style" for="">Población</label><input class="input-user mt-2 mb-3" name="city" type="text"
        placeholder="Población" required>
    <label class="label-style" for="">Código Postal</label><input class="input-user mt-2 mb-3" name="cp" type="text"
        placeholder="Código Postal" required>
    <label class="label-style" for="">Correo electrónico</label><input class="input-user mt-2 mb-3" name="mail"
        type="email" placeholder="Correo electrónico" required>
    <div class="d-flex justify-content-end"> <button class="rm-input-style text-decoration-underline">Mostrar
            contraseña</button></div>
    <label class="label-style" for="">Contraseña</label><input class="input-user mt-2 mb-3" name="pwd" type="password"
        placeholder="Contraseña" required>
    <label class="label-style" for="">Repite la contraseña</label><input class="input-user mt-2 mb-1" name="pwd"
        type="password" placeholder="Vuelve a introducir la contraseña" required>
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
        <p class="user-page-p fw-normal">HE LEÍDO Y ACEPTO LOS <a class="text-decoration-underline text-reset" href="">T
                & C</a> Y LA <a class="text-decoration-underline text-reset" href="">POLÍTICA DE
                PRIVACIDAD</a> DE DR.
            MARTENS</p>
    </div>
    <input class="rm-input-style input-submit text-center mt-3 p-2" type="submit" value="CREAR UNA CUENTA">
</form>