<body>
    <!-- Se incluye el banner que va en el header -->
    <?php
    include_once('app/views/partials/header_banner.php');
    ?>
    <main>
        <section class="container-fluid">
            <div class="container d-flex flex-column justify-content-center align-items-center mt-5 mb-5 ">
                <h2 class="mb-5">TOP VENTAS</h2>
                <div class="row justify-content-center">
                    <?php
                    //Inclusión de las hamburguesas más vendidas de la base de datos
                    foreach ($topProducts as $product) { ?>
                        <article class="card div-best-seller col-6 col-sm-6 col-md-2">
                            <a class="img-product"
                                href="?controller=product&action=addToCart&productId=<?= $product->getProduct_id() ?>"><img
                                    class="card-img-top pb-5 ps-3 pe-3" src="public/images/<?= $product->getMain_photo() ?>"
                                    alt="Hamburguesa"></a>
                            <div class="card-body ps-0 pt-2">
                                <h5 class="card-title"><?= strtoupper($product->getProduct_name()) ?></h5>
                                <p class="card-text"><?= number_format($product->getBase_Price(), '2', ',') ?>€</p>
                            </div>
                        </article>
                    <?php } ?>
                </div>
                <div class="mt-5 mb-4 col-8 col-md-3 align-self-center">
                    <div class="text-center">
                        <a class="pri-btn" href="?controller=product&action=showMenu">VER TODOS LOS PRODUCTOS</a>
                    </div>
                </div>

            </div>
        </section>

        <!-- Se incluye el banner del cuerpo de la página para poder modificar dado el caso -->
        <?php
        include_once('app/views/partials/body_banner.php');
        ?>

        <section class="container-fluid mb-5">
            <div class="container mt-5">
                <h2>CONCEBIDOS PARA SER DEGUSTADOS</h2>
                <div class=" mt-4 mb-4 d-none d-md-flex gap-2 ">

                    <?php foreach ($categories as $category) { ?>

                        <!-- Se cargan todos los nombres de las categorías de la base de datos-->
                        <div><a class="snd-btn-1"
                                href="?controller=product&action=showMenu&filter=<?= $category->getCategory_name() ?>"><?= strtoupper($category->getCategory_name()) ?></a>
                        </div>

                    <?php }
                    ?>
                </div>
                <div class="row justify-content-center">

                    <article class="div-category col-sm-12 col-md-12 col-lg-4 mt-5 mt-md-0 mb-sm-5 mb-md-5">
                        <a class=" w-100 category-img-link"
                            href="?controller=product&action=showMenu&filter=Hamburguesas"><img
                                class=" image-fluidcard-img-to category-img" src="public/images/ad-burger.avif"
                                alt="Manos soteniendo hamburguesa"></a>
                        <div class="card-body body-ctagory h-auto ps-0 pt-0">
                            <h5 class="card-title p-1 title-categories">PRODUCTOS CON INGREDIENTES FRESCOS</h5>
                            <p class="card-text p-index-categories">PROCEDENTES DE PRODUCTORES LOCALES</p>
                        </div>
                    </article>


                    <article class=" div-category col-sm-12 col-md-12 col-lg-4 mt-5 mt-md-0 mb-sm-5 mb-md-0">
                        <a class=" w-100 category-img-link"
                            href="?controller=product&action=showMenu&filter=Complementos"><img
                                class="image-fluid card-img-top category-img" src="public/images/fries.jpeg"
                                alt="Chicos comiendo patatas sobre cesped"></a>
                        <div class="card-body body-ctagory h-auto ps-0 pt-0">
                            <h5 class="card-title p-1 title-categories">COMPLEMENTOS QUE TE SIENTAN BIEN</h5>
                            <p class="card-text p-index-categories">COMPLEMENTOS SANOS Y VARIADOS SIN GLUTEN</p>
                        </div>
                    </article>


                    <article class=" div-category col-sm-12 col-md-12 col-lg-4 mt-5 mt-md-0 mb-sm-5 mb-md-0">
                        <a class="category-img-link  w-100"
                            href="?controller=product&action=showMenu&filter=Bebidas"><img
                                class="image-fluid card-img-top category-img" src="public/images/cola-zero.webp"
                                alt="Mano sosteniendo cola zero"></a>
                        <div class="card-body body-ctagory h-auto ps-0 pt-0 ">
                            <h5 class="card-title p-1 title-categories">ACOMPÁÑATE DE NUESTRAS BEBIDAS</h5>
                            <p class="card-text p-index-categories">CON REFRESCOS LIBRES DE AZÚCARES</p>
                        </div>
                    </article>


                </div>
                <div class="container  mt-4 mt-md-1">
                    <div class="w-100 d-flex justify-content-center">
                        <a class="mt-5 mb-2 pri-btn" href="?controller=product&action=showMenu">VER AHORA</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>