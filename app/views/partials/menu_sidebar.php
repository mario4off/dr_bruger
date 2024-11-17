<aside class="col-12 col-sm-6 col-md-3 sidebar">

    <div class="container-fluid">
        <div class="container d-flex flex-column mt-3 mb-3">

            <?php
            foreach ($categories as $category) {
                ?>

                <a href="?controller=product&action=showMenu&filter=<?= $category->getCategory_id() ?>"
                    class="snd-btn-2 d-flex justify-content-between align-items-center mb-2">
                    <p><?= strtoupper($category->getCategory_name()) ?></p>
                    <i class="fa-solid fa-plus fa-add-icon"></i>
                </a>

            <?php } ?>

        </div>
    </div>
</aside>