<section class="container m-5 mt-3 mb-3">
    <h1 class="ms-4 pt-3 mb-3">MI CUENTA</h1>
    <div class="container-fluid d-none-block d-md-flex justify-content-center gap-5">

        <?php
        if (isset($_SESSION['mail'])) {

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