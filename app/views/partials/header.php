<header>
    <div class="upper-banner-header container-fluid d-flex justify-content-center">
        <div class="row div-upper-header container p-1 flex-column flex-md-row">
            <div class="col-12 col-md-6 col-ld-6  d-flex justify-content-center align-items-center mt-1 mb-1">
                <a class="header-promos h-1" href="">Regístrate Ahora: -10% de descuento en tu primer pedido</a>
            </div>
            <div class="col-12 col-md-6 col-ld-6 d-flex justify-content-center align-items-center">
                <a class="header-promos h-1" href="">Todos los Martes: TODAS las hamburguesas al mismo precio</a>

            </div>
        </div>
    </div>
    <nav class="container-fluid custom-navbar">
        <div class=" container header-container p-2 d-flex flex-row align-items-center ">
            <a href=""><img id="header-logo" class="image-fluid" src="/drburger.com/public/images/dr_burger_logo.svg"
                    alt="logo"></a>


            <ul class="d-flex flex-row d-none d-sm-flex mb-0 justify-content-around">
                <li><a class="nav-link header-link <?= $_GET['action'] == 'index' ? 'active' : '' ?>"
                        href="?controller=product&action=index">INICIO</a>
                </li>
                <li><a class="nav-link header-link <?= $_GET['action'] == 'showMenu' ? 'active' : '' ?>" href="
                        ?controller=product&action=showMenu">MENÚ</a></li>
                <li><a class="nav-link header-link <?= $_GET['action'] == 'showContact' ? 'active' : '' ?>" href="
                        #">CONTACTO</a></li>
                <?php

                if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                    ?>

                    <li><a class="nav-link header-link <?= $_GET['action'] == 'showPannel' ? 'active' : '' ?>"
                            href="?controller=admin&action=showPannel">ADMINISTRACIÓN</a></li>

                    <?php
                }
                ?>
            </ul>
            <ul class="d-flex flex-column d-sm-none mb-0 justify-content-center">
                <li><a class="nav-link header-link <?= $_GET['action'] == 'index' ? 'active' : '' ?>"
                        aria-current="page" href="#">INICIO</a></li>
                <li><a class="nav-link header-link <?= $_GET['action'] == 'index' ? 'active' : '' ?>"
                        href="?controller=product&action=showMenu">MENÚ</a>
                </li>
                <li><a class="nav-link header-link <?= $_GET['action'] == 'index' ? 'active' : '' ?>"
                        href="#">CONTACTO</a></li>
                <?php

                if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                    ?>

                    <li><a class="nav-link header-link <?= $_GET['action'] == 'showPannel' ? 'active' : '' ?>"
                            href="?controller=admin&action=showPannel">ADMINISTRACIÓN</a></li>

                    <?php
                }
                ?>
            </ul>


            <ul class="navbar-nav-right ms-auto d-md-flex header-icons">
                <li class="pt-2 pb-2"><a class="nav-link" href="?controller=user&action=showUser"><i
                            class="fa-solid fa-user-large fa-lg d-none d-sm-inline icon-header-size <?= isset($_SESSION['mail']) ? 'icon-active' : ' ' ?>"></i><i
                            class=" fa-solid fa-user-large fa-sm d-sm-none <?= isset($_SESSION['mail']) ? 'icon-active' : ' ' ?>"></i></a>
                </li>
                <li class="cart-container pt-2"><a class="nav-link"
                        href="?controller=order&action=getCheckout&delivery=false"><i
                            class="fa-solid fa-bag-shopping fa-lg d-none d-sm-inline icon-header-size <?= isset($_SESSION['cart']) ? 'icon-active' : ' ' ?>">
                            <?php if (isset($_SESSION['cart'])) {
                                ?><span class="cart-count d-flex justify-content-center align-items-center">
                                    <?php $count = 0;
                                    ;
                                    foreach ($_SESSION['cart'] as $item) {
                                        $count += $item->getQuantity();
                                    }
                                    echo $count; ?>
                                </span>
                            <?php } ?> </i><i
                            class="fa-solid fa-bag-shopping fa-sm d-sm-none <?= isset($_SESSION['cart']) ? 'icon-active' : ' ' ?>"></i>

                    </a>
                </li>
                <li class="pt-2"><a class="nav-link" href="?controller=user&action=logout"><i
                            class="fa-solid fa-arrow-right-from-bracket fa-lg d-none d-sm-inline icon-header-size"></i><i
                            class="fa-solid fa-arrow-right-from-bracket fa-sm d-sm-none"></i></a></li>
            </ul>
            </ul>




        </div>
    </nav>
</header>