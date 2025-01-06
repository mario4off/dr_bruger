<section class="container m-5 mt-3 mb-3">
    <h1 class="ms-4 pt-3 mb-3">MI CUENTA</h1>
    <div class="container-fluid d-none-block d-md-flex justify-content-center gap-5">

        <?php

        // En primer lugar, se comprueba si hay variable de sesión del usuario para mostrar el registro/login o mostrar el perfil
        // del usuario
        
        if (isset($_SESSION['mail'])) {

            // En segundo lugar, se mostrará el historial de pedidos o los datos personales dependiendo de la sección de url
            // aunque por defecto se irá al de datos personales
        
            if (isset($_GET['section']) && $_GET['section'] == 'orders') {
                include_once('app/views/partials/order_history.php');
            } else {
                include_once('app/views/partials/profile.php');
            }


        } else {

            include_once('app/views/partials/register.php');
            include_once('app/views/partials/login.php');
        }

        ?>

    </div>
</section>
<div id="bottom-decoration-account"></div>