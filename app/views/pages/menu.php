<body>
    <div id="body-content-menu">
        <main>
            <section class="m-5 mt-3">
                <div class="container ms-4 pt-3 mb-3 grid-title-menu">
                    <h1>NUESTRO MENÚ</h1>
                </div>
                <div class="container-fluid ms-4">
                    <!-- Se crea un contador para la muestra del total de artículos mostrados -->
                    <p><?= count($products) ?> artículos | Filtrar por: </p>


                </div>
                <div class="container-fluid d-flex flex-column flex-md-row">
                    <!-- Se hace una inclusión por un lado de la barra de filtros y del grid o parrilla con los productos cargados de 
                     la base de datos -->
                    <?php include_once('app/views/partials/menu_sidebar.php'); ?>
                    <?php include_once('app/views/partials/product_grid.php'); ?>
                </div>
            </section>
        </main>


    </div>
</body>