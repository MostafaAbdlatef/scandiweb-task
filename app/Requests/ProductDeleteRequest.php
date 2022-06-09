<?php

require_once __DIR__ . "\../Models/Product.php";

class ProductDeleteRequest extends Product
{
}

if (isset($_POST)) {
    if (empty($_POST['product-delete'])) {
        header('location:../../index.php');
    } else {
        $deleteProduct = new ProductDeleteRequest;
        $all_id = $_POST['product-delete'];
        $extract_id = implode(',', $all_id);
        $deleteProduct->setId($extract_id);
        $deleteProduct->delete();
        header('location:../../index.php');
    }
}
