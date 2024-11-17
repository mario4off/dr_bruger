<body>
    <?php
    include_once(path_base . 'app/views/partials/header_banner.php');
    ?>
    <main>
        <section class="container-fluid">
            <div class="container d-flex flex-column justify-content-center align-items-center mt-5 mb-5">
                <h2 class="mb-5">TOP VENTAS</h2>
                <div class="row justify-content-center">
                    <?php
                    foreach ($topProducts as $product) { ?>
                        <article class="card div-best-seller col-6 col-sm-6 col-md-2">
                            <a class="img-product" href=""><img class="card-img-top pb-5 ps-3 pe-3"
                                    src="/drburger.com/public/images/<?= $product->getMain_photo() ?>"
                                    alt="Card image cap"></a>
                            <div class="card-body ps-0 pt-2">
                                <h5 class="card-title"><?= strtoupper($product->getProduct_name()) ?></h5>
                                <p class="card-text"><?= $product->getBase_Price() ?>€</p>
                            </div>
                        </article>
                    <?php } ?>
                </div>
                <div class="mt-5 mb-4 col-8 col-md-3 align-self-center">
                    <div class="text-center">
                        <a class="pri-btn" href="">VER TODOS LOS PRODUCTOS</a>
                    </div>
                </div>

            </div>
        </section>

        <?php
        include_once(path_base . 'app/views/partials/body_banner.php');
        ?>

        <section class="container-fluid mb-5">
            <div class="container mt-5">
                <h2>CONCEBIDOS PARA SER DEGUSTADOS</h2>
                <div class=" mt-4 mb-4 d-none d-md-flex gap-2 ">

                    <?php foreach ($categories as $category) { ?>

                        <div><a class="snd-btn-1" href=""><?= strtoupper($category->getCategory_name()) ?></a></div>

                    <?php }
                    ?>
                </div>
                <div class="row justify-content-center">

                    <article class="div-category col-sm-12 col-md-12 col-lg-4 mt-5 mt-md-0 mb-sm-5 mb-md-5">
                        <a class=" w-100 category-img-link" href=""><img class=" image-fluidcard-img-to category-img"
                                src="/drburger.com/public/images/ad-burger.avif" alt="Card image cap"></a>
                        <div class="card-body body-ctagory h-auto ps-0 pt-0">
                            <h5 class="card-title p-1 title-categories">PRODUCTOS CON INGREDIENTES FRESCOS</h5>
                            <p class="card-text p-index-categories">PROCEDENTES DE PRODUCTORES LOCALES</p>
                        </div>
                    </article>


                    <article class=" div-category col-sm-12 col-md-12 col-lg-4 mt-5 mt-md-0 mb-sm-5 mb-md-0">
                        <a class=" w-100 category-img-link" href=""><img class="image-fluid card-img-top category-img"
                                src="/drburger.com/public/images/fries.jpeg" alt="Card image cap"></a>
                        <div class="card-body body-ctagory h-auto ps-0 pt-0">
                            <h5 class="card-title p-1 title-categories">COMPLEMENTOS QUE TE SIENTAN BIEN</h5>
                            <p class="card-text p-index-categories">COMPLEMENTOS SANOS Y VARIADOS SIN GLUTEN</p>
                        </div>
                    </article>


                    <article class=" div-category col-sm-12 col-md-12 col-lg-4 mt-5 mt-md-0 mb-sm-5 mb-md-0">
                        <a class="category-img-link  w-100" href=""><img class="image-fluid card-img-top category-img"
                                src="/drburger.com/public/images/cola-zero.webp" alt="Card image cap"></a>
                        <div class="card-body body-ctagory h-auto ps-0 pt-0 ">
                            <h5 class="card-title p-1 title-categories">ACOMPÁÑATE DE NUESTRAS BEBIDAS</h5>
                            <p class="card-text p-index-categories">CON REFRESCOS LIBRES DE AZÚCARES</p>
                        </div>
                    </article>


                </div>
                <div class="container  mt-4 mt-md-1">
                    <div class="w-100 d-flex justify-content-center">
                        <a class="mt-5 pri-btn" href="">VER AHORA</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>