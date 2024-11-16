<body>
    <?php
    include_once(path_base . 'app/views/partials/header_banner.php');
    ?>
    <main>
        <section class="container-fluid">
            <div class="container d-flex flex-column align-items-center mt-5 mb-5">
                <h2 class="mb-5">TOP VENTAS</h2>
                <div class="row justify-content-center">
                    <?php
                    foreach ($topProducts as $product) { ?>
                        <article class="card div-best-seller col-6 col-sm-6 col-md-2">
                            <a class="img-best-seller" href=""><img class="card-img-top pb-5 ps-3 pe-3"
                                    src="/drburger.com/public/images/<?= $product->getMain_photo() ?>"
                                    alt="Card image cap"></a>
                            <div class="card-body ps-0 pt-2">
                                <h5 class="card-title"><?= strtoupper($product->getProduct_name()) ?></h5>
                                <p class="card-text"><?= $product->getBase_Price() ?>€</p>
                            </div>
                        </article>
                    <?php } ?>
                </div>
                <div class="mt-5 mb-4 col-2">
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
                <div class=" mt-4 mb-4 d-flex gap-2 flex-row">

                    <?php foreach ($categories as $category) { ?>

                        <div><a class="snd-btn-1" href=""><?= strtoupper($category->getCategory_name()) ?></a></div>

                    <?php }
                    ?>
                </div>
                <div class="row justify-content-center mb-4">

                    <article class="col-3 div-category col-sm-12 col-md-4 ">
                        <a class=" w-100 category-img-link" href=""><img class="card-img-to category-img"
                                src="/drburger.com/public/images/ad-burger.avif" alt="Card image cap"></a>
                        <div class="card-body h-auto ps-0 pt-0">
                            <h5 class="p-1 title-categories">HAMBURGUESAS CON INGREDIENTES FRESCOS</h5>
                            <p class="p-index-categories">PROCEDENTES DE PRODUCTORES LOCALES</p>
                        </div>
                    </article>


                    <article class="col-3 div-category col-sm-12 col-md-4">
                        <a class=" w-100 category-img-link" href=""><img class="card-img-top category-img"
                                src="/drburger.com/public/images/fries.jpeg" alt="Card image cap"></a>
                        <div class="card-body h-auto ps-0 pt-0">
                            <h5 class="p-1 title-categories">COMPLEMENTOS QUE TE SIENTAN BIEN</h5>
                            <p class="p-index-categories">COMPLEMENTOS SANOS Y VARIADOS SIN GLUTEN</p>
                        </div>
                    </article>


                    <article class=" col-3  div-category col-sm-12 col-md-4 ">
                        <a class="category-img-link  w-100" href=""><img class=" card-img-top category-img"
                                src="/drburger.com/public/images/cola-zero.webp" alt="Card image cap"></a>
                        <div class="card-body h-auto ps-0 pt-0">
                            <h5 class="p-1 title-categories">ACOMPAÑA TU COMIDA CON NUESTRAS BEBIDAS</h5>
                            <p class="p-index-categories">CON REFRESCOS LIBRES DE AZÚCARES</p>
                        </div>
                    </article>


                </div>
                <div class="container d-flex justify-content-center mt-5">
                    <div class="text-center">
                        <a class="mt-5 pri-btn" href="">VER AHORA</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>