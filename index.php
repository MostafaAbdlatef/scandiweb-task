<?php

include_once "layouts/header.php"; // header file
include_once "app/models/Product.php"; // product model
include_once "app/Classes/dvd.php";
include_once "app/Classes/book.php";
include_once "app/Classes/furniture.php";

$productsObject = new Product();
$productsResult = $productsObject->read();
?>
<div class="container">
    <!-- header -->
    <div class="row justify-content-between align-items-center pt-5 pb-3 border-bottom">
        <div class="col-8">
            <div class="h1">Product List</div>
        </div>
        <div class="col-1">
            <a href="add-product.php" class="btn btn-outline-success">ADD</a>
        </div>
        <div class="col-2">
            <button type="submit" name="delete-multi-prod" form="delete-product" class="btn btn-outline-danger" id="delete-product-btn">MASS DELETE</button>
        </div>
    </div>
    <!-- products -->
    <form id="delete-product" method="POST" action="app/Requests/ProductsRequest.php">
        <div class="row py-5">
            <?php
            if ($productsResult) {
                $products = $productsResult->fetch_all(MYSQLI_ASSOC);
                foreach ($products as $index => $product) {
            ?>
                    <div class="col-3 product my-3">
                        <div class="px-1 product border border-dark rounded">
                            <div class="container">
                                <div class="row py-3 px-3">
                                    <div class="col-12 form-check">
                                        <input type="checkbox" class="form-check-input delete-checkbox" name="product-delete[]" value="<?= $product['id'] ?>">
                                    </div>
                                </div>
                                <div class="row font-weight-bold justify-content-center align-items-center">
                                    <p class="m-0"><?= $product['sku'] ?></p>
                                </div>
                                <div class="row font-weight-bold justify-content-center align-items-center">
                                    <p class="m-0"><?= $product['name'] ?></p>
                                </div>
                                <div class="row font-weight-bold justify-content-center align-items-center">
                                    <p class="m-0"><?= $product['price'] . "$" ?></p>
                                </div>
                                <div class="row font-weight-bold justify-content-center align-items-center">
                                    <p class="m-0">
                                        <?php
                                        // dvd object
                                        $dvd = new dvd();
                                        $dvd->setSize($product['size']);
                                        echo ($dvd->getValue());
                                        // book object
                                        $book = new book();
                                        $book->setWeight($product['weight']);
                                        echo ($book->getValue());
                                        // furniture object
                                        $furniture = new furniture();
                                        $furniture->setLength($product['length']);
                                        $furniture->setWidth($product['width']);
                                        $furniture->setHeight($product['height']);
                                        echo ($furniture->getValue());
                                        ?>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="col-12 text-center">
                    <p class="h1 text-muted">No Items to Show!</p>
                </div>
            <?php
            }
            ?>
        </div>
    </form>
</div>

<!-- footer file -->
<?php
include_once "layouts/footer.php";
?>