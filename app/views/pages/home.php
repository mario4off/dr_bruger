<body>
    <?php
    include_once(path_base . 'app/views/partials/header_banner.php');
    ?>
    <main>
        <section class="container-fluid">
            <div class="container d-flex flex-column align-items-center mt-5 mb-5">
                <h2 class="mb-5">LAS PREFERIDAS</h2>
                <div class="row justify-content-center">


                    <?php
                    foreach ($products as $product) { ?>
                        <div class="card div-best-seller col-6 col-sm-6 col-md-2">
                            <a class="img-best-seller" href=""><img class="card-img-top pb-5 ps-3 pe-3"
                                    src="/drburger.com/public/images/<?= $product->getMain_photo() ?>"
                                    alt="Card image cap"></a>
                            <div class="card-body ps-0 pt-2">
                                <h5 class="card-title"><?= strtoupper($product->getProduct_name()) ?></h5>
                                <p class="card-text"><?= $product->getBase_Price() ?>€</p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class=" mt-5 mb-4 "> <a class="col-1 w-25 pri-btn " href="">VER TODOS LOS PRODUCTOS</a>
                </div>

            </div>
        </section>

        <?php
        include_once(path_base . 'app/views/partials/body_banner.php');
        ?>
    </main>
</body>

</html>