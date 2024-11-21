<div class="container-fluid row ps-0">

    <div class="col-3 d-flex justify-content-start">
        <ul class="ps-0">
            <li class="mt-3"><a class="links-on-white" href="?controller=user&action=showUser&section=profile">MI
                    PERFIL</a></li>
            <li class="mt-3"><a class="links-on-white" href="?controller=user&action=showUser&section=orders">MIS
                    PEDIDOS</a>
            </li>
        </ul>
    </div>
    <div class="col-5">
        <div class="container">
            <h2 class="mb-1">MI PERFIL</h2>
            <p>Usa este formulario para actualizar tus detalles personales</p>
            <form action="?controller=user&action=editUser" method="POST">
                <label class="label-style " for="">Nombre</label><input class="input-user mt-3 mb-2" name="name"
                    type="text" placeholder="Nombre" required value="<?= $_SESSION['name'] ?>">
                <label class="label-style" for="">Apellidos</label><input class="input-user mt-2 mb-2" name="lastname"
                    type="text" placeholder="Apellidos" required value="<?= $_SESSION['lastName'] ?>">
                <label class="label-style" for="">Teléfono móvil</label><input class="input-user mt-2 mb-2" name="phone"
                    type="text" placeholder="Teléfono móvil" required value="<?= $_SESSION['phone'] ?>">
                <label class="label-style" for="">Dirección</label><input class="input-user mt-2 mb-2" name="address"
                    type="text" placeholder="Dirección completa" required value="<?= $_SESSION['address'] ?>">
                <label class="label-style" for="">Población</label><input class="input-user mt-2 mb-2" name="city"
                    type="text" placeholder="Población" required value="<?= $_SESSION['city'] ?>">
                <label class="label-style" for="">Código Postal</label><input class="input-user mt-2 mb-2" name="cp"
                    type="text" placeholder="Código Postal" required value="<?= $_SESSION['cp'] ?>">
                <label class="label-style" for="">Correo electrónico</label><input class="input-user mt-2 mb-2"
                    name="mail" type="email" placeholder="Correo electrónico" required value="<?= $_SESSION['mail'] ?>">
                <label class="label-style" for="">Contraseña</label><input class="input-user mt-2 mb-2" name="pwd"
                    type="password" placeholder="Contraseña" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}"
                    required value="<?= $_SESSION['pwd'] ?>">

                <div class="container-fluid d-flex ps-0 pe-0">
                    <input class="input-submit w-50 ms-0 m-4 d-flex align-items-center justify-content-center"
                        type="submit" value="SALVAR"></input>
                    <a class="input-snd-submit w-50 me-0 m-4 d-flex align-items-center justify-content-center"
                        href="?controller=product&action=showMenu">CANCELAR</a>
                </div>

            </form>

        </div>
    </div>

</div>