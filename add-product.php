<?php
include_once "layouts/header.php";
require_once "app/models/Product.php";
require_once "app/Requests/ProductsRequest.php";

?>

<div class="container">
    <!-- header -->
    <div class="row justify-content-between align-items-center pt-5 pb-3 border-bottom">
        <div class="col-8">
            <div class="h1 text-warning">Product Add</div>
        </div>
        <div class="col-1">
            <button type="submit" onclick="saveData()" form="product_form" id="submit" class="btn btn-outline-success">Save</button>
        </div>
        <div class="col-2">
            <a href="index.php" class="btn btn-outline-danger">Cancel</a>
        </div>
    </div>
    <!-- form -->
    <div class="row py-5">
        <form id="product_form" class="col-4" method="POST" action="app/Requests/ProductsRequest.php">
            <!-- sku field -->
            <div class="form-row">
                <div class="form-group col-12">
                    <input class="form-control form-data" name="sku" id="sku" placeholder="SKU">
                    <span id="sku-error" class="text-danger"></span>
                </div>
            </div>
            <!-- end sku field -->
            <!-- name field -->
            <div class="form-group">
                <input class="form-control form-data" name="name" id="name" placeholder="Name">
                <span id="name-error" class="text-danger"></span>
            </div>
            <!-- end name field -->
            <!-- price field -->
            <div class="form-group">
                <input class="form-control form-data" name="price" id="price" placeholder="Price ($)">
                <span id="price-error" class="text-danger"></span>
            </div>
            <!-- end price field -->
            <!-- product type field -->
            <div class="form-row">
                <div class="form-group col-8">
                    <select id="productType" name="type" class="form-control form-data">
                        <option disabled selected>Type switcher</option>
                        <option value="dvd">DVD</option>
                        <option value="furniture">Furniture</option>
                        <option value="book">Book</option>
                    </select>
                </div>
                <span id="type-error" class="text-danger"></span>

            </div>
            <!-- end product type field -->
            <!-- option dvd -->
            <div class="form-group show-hide" id="dvd">
                <input class="form-control form-data" name="size" id="size" placeholder="Size (MB)">
                <span id="size-error" class="text-danger"></span>
                <p class="text-muted">Please provide size in MB</p>
            </div>
            <!-- end option dvd -->
            <!-- option furniture -->
            <div class="form-group show-hide" id="furniture">
                <input class="form-control form-data" name="length" id="length" placeholder="Length (CM)">
                <span id="length-error" class="text-danger"></span>
                <!-- ================================================================================= -->
                <input class="form-control form-data my-2" name="width" id="width" placeholder="Width (CM)">
                <span id="width-error" class="text-danger"></span>
                <!-- ================================================================================= -->
                <input class="form-control form-data my-2" name="height" id="height" placeholder="Height (CM)">
                <span id="height-error" class="text-danger"></span>
                <p class="text-muted">Please provide dimensions in LxWxH Format</p>
            </div>
            <!-- end option furniture -->
            <!-- option book -->
            <div class="form-group show-hide" id="book">
                <input class="form-control form-data" name="weight" id="weight" placeholder="weight (KG)">
                <span id="weight-error" class="text-danger"></span>
                <p class="text-muted">Please provide weight in KG</p>
            </div>
            <!-- end option book -->
        </form>
    </div>
    <!-- end form -->
</div>
<?php
include_once "layouts/footer.php";
?>