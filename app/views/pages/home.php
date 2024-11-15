<body>
    <?php
    include_once(path_base . 'app/views/partials/header_banner.php');
    ?>
    <main>
        <table>
            <thead>
                <tr>
                    <th>ID producto</th>
                    <th>Nombre Producto</th>
                    <th>Ruta de la foto</th>
                    <th>Promoción aplicable (id)</th>
                    <th>Categoría (id)</th>
                    <th>Precio</th>
                    <th>Descripción del producto</th>
                </tr>
            </thead>

            <?php

            foreach ($products as $product) {
                echo ' <tr>
    <td>' . $product->getProduct_id() . '</td>
    <td>' . $product->getProduct_name() . '</td>
    <td>' . $product->getMain_photo() . '</td>
    <td>' . $product->getPromotion_id() . '</td>
    <td>' . $product->getCategory_id() . '</td>
    <td>' . $product->getBase_price() . '</td>
    <td>' . $product->getProduct_description() . '</td>
</tr>';
            }
            ?>


            <?php ?>

        </table>

        <?php
        include_once(path_base . 'app/views/partials/body_banner.php');
        ?>
    </main>
</body>

</html>