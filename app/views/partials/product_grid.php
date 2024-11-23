<div class="container row grid-products-area mt-3 w-100 ">
    <?php
    foreach ($products as $product) { ?>
        <article class="card div-best-seller col-5 col-sm-3 col-md-2 me-2 mb-4 p-1 pt-0 d-flex flex-column">
            <a class="img-product "
                href="?controller=product&action=addtoCart&productId=<?= $product->getProduct_id() ?>"><img
                    class="card-img-top pb-5 ps-3 pe-3" src="/drburger.com/public/images/<?= $product->getMain_photo() ?>"
                    alt="Card image cap"></a>
            <div class="card-body d-flex flex-column justify-content-between ps-0 pt-2 pb-0">
                <h5 class="card-title"><?= strtoupper($product->getProduct_name()) ?></h5>
                <p class="card-text"><?= str_replace('.', ',', $product->getBase_Price()) ?>€</p>
            </div>
        </article>
    <?php } ?>
</div>