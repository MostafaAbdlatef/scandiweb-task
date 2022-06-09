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
            <button type="submit" form="product-form" class="btn btn-outline-success">Save</button>
        </div>
        <div class="col-2">
            <a href="index.php" class="btn btn-outline-danger">Cancel</a>
        </div>
    </div>
    <!-- form -->
    <div class="row py-5">
        <form id="product-form" class="col-4" method="POST" action="app/Requests/ProductsRequest.php">
            <!-- sku field -->
            <div class="form-row">
                <div class="form-group col-12">
                    <input class="form-control <?php if (isset($_SESSION['old-values']['sku']) && !empty($_SESSION['old-values']['sku'] && !isset($_SESSION['validation']['sku-validation']))) {
                                                    echo "is-valid";
                                                } elseif (isset($_SESSION['validation']['sku-validation'])) {
                                                    echo "is-invalid";
                                                } ?>" name="sku" id="sku" placeholder="SKU" value="<?php
                                                                                                    // get submitted value if it's valid
                                                                                                    if (isset($_SESSION['old-values']['sku'])) {
                                                                                                        echo $_SESSION['old-values']['sku'];
                                                                                                    } else {
                                                                                                        echo "";
                                                                                                    } ?>">
                    <?php
                    // sku validation
                    //required
                    if (isset($_SESSION['validation']['sku-validation']['sku-required'])) {
                        $skuRequired = $_SESSION['validation']['sku-validation']['sku-required'];
                    }
                    //invalid
                    if (isset($_SESSION['validation']['sku-validation']['sku-invalid'])) {
                        $skuInvalid = $_SESSION['validation']['sku-validation']['sku-invalid'];
                    }
                    //unique
                    if (isset($_SESSION['validation']['sku-validation']['sku-exists'])) {
                        $skuExists = $_SESSION['validation']['sku-validation']['sku-exists'];
                    }

                    ?>
                    <p class="m-0 text-danger"><?php if (isset($skuRequired)) {
                                                    echo $skuRequired;
                                                } elseif (isset($skuExists)) {
                                                    echo $skuExists;
                                                } elseif (isset($skuInvalid)) {
                                                    echo $skuInvalid;
                                                } ?></p>
                </div>
            </div>
            <!-- end sku field -->
            <!-- name field -->
            <div class="form-group">
                <input class="form-control <?php if (isset($_SESSION['old-values']['name']) && !empty($_SESSION['old-values']['name']) && empty($_SESSION['validation']['name-validation'])) {
                                                echo "is-valid";
                                            } elseif (isset($_SESSION['validation']['name-validation'])) {
                                                echo "is-invalid";
                                            } ?>" name="name" id="name" placeholder="Name" value="<?php
                                                                                                    // get submitted value if it's valid
                                                                                                    if (isset($_SESSION['old-values']['name'])) {
                                                                                                        echo $_SESSION['old-values']['name'];
                                                                                                    } else {
                                                                                                        echo "";
                                                                                                    } ?>">
                <?php
                //name validation
                //required
                if (isset($_SESSION['validation']['name-validation']['name-required'])) {
                    $nameRequired = $_SESSION['validation']['name-validation']['name-required'];
                }
                //invalid
                if (isset($_SESSION['validation']['name-validation']['name-invalid'])) {
                    $nameInvalid = $_SESSION['validation']['name-validation']['name-invalid'];
                }
                ?>
                <p class="m-0 text-danger"><?php if (isset($nameRequired)) {
                                                echo $nameRequired;
                                            } elseif (isset($nameInvalid)) {
                                                // foreach ($nameInvalid as $key => $value) {
                                                //     echo $value;
                                                // }
                                                echo $nameInvalid;
                                            }
                                            ?></p>
            </div>
            <!-- end name field -->
            <!-- price field -->
            <div class="form-group">
                <input class="form-control <?php if (isset($_SESSION['old-values']['price']) && !empty($_SESSION['old-values']['price'])) {
                                                echo "is-valid";
                                            } elseif (isset($_SESSION['validation']['price-validation'])) {
                                                echo "is-invalid";
                                            } ?>" name="price" id="price" placeholder="Price ($)" value="<?php
                                                                                                            //get submitted value if it's valid
                                                                                                            if (isset($_SESSION['old-values']['price'])) {
                                                                                                                echo $_SESSION['old-values']['price'];
                                                                                                            } else {
                                                                                                                echo "";
                                                                                                            } ?>">
                <?php
                // price validation
                if (isset($_SESSION['validation']['price-validation']['price-required'])) {
                    $priceRequired = $_SESSION['validation']['price-validation']['price-required'];
                }
                ?>
                <p class="m-0 text-danger"><?php if (isset($priceRequired)) {
                                                echo $priceRequired;
                                            } ?></p>
            </div>
            <!-- end price field -->
            <!-- product type field -->
            <div class="form-row">
                <div class="form-group col-8">
                    <select id="product-type" name="product-type" class="form-control">
                        <option disabled selected>Type switcher</option>
                        <option value="dvd">DVD</option>
                        <option value="furniture">Furniture</option>
                        <option value="book">Book</option>
                    </select>
                </div>
                <?php
                //product type validation
                if (isset($_SESSION['validation']['product-type-validation']['product-type-required'])) {
                    $typeRequired = $_SESSION['validation']['product-type-validation']['product-type-required'];
                }
                ?>
                <p class="m-0 text-danger"><?php if (isset($typeRequired)) {
                                                echo $typeRequired;
                                            } ?></p>

            </div>
            <!-- end product type field -->
            <!-- option dvd -->
            <div class="form-group show-hide" id="dvd">
                <input class="form-control <?php if (isset($_SESSION['old-values']['size']) && !empty($_SESSION['old-values']['size'])) {
                                                echo "is-valid";
                                            } elseif (isset($_SESSION['validation']['size-validation'])) {
                                                echo "is-invalid";
                                            } ?>" name="size" id="size" placeholder="Size (MB)" value="<?php
                                                                                                        // get submitted value if it's valid
                                                                                                        if (isset($_SESSION['old-values']['size'])) {
                                                                                                            echo $_SESSION['old-values']['size'];
                                                                                                        } else {
                                                                                                            echo "";
                                                                                                        } ?>">
                <p class="text-muted">Please provide size in MB</p>
                <?php
                // size validation
                if (isset($_SESSION['validation']['size-validation']['size-required'])) {
                    $required = $_SESSION['validation']['size-validation']['size-required'];
                }
                ?>
                <p class="m-0 text-danger"><?php if (isset($required)) {
                                                echo $required;
                                            } ?></p>
            </div>
            <!-- end option dvd -->
            <!-- option furniture -->
            <div class="form-group show-hide" id="furniture">
                <input class="form-control <?php if (isset($_SESSION['old-values']['length']) && !empty($_SESSION['old-values']['length'])) {
                                                echo "is-valid";
                                            } elseif (isset($_SESSION['validation']['length-validation'])) {
                                                echo "is-invalid";
                                            } ?>" name="length" id="length" placeholder="Length (CM)" value="<?php
                                                                                                                // get submitted value if it's valid
                                                                                                                if (isset($_SESSION['old-values']['length'])) {
                                                                                                                    echo $_SESSION['old-values']['length'];
                                                                                                                } else {
                                                                                                                    echo "";
                                                                                                                } ?>">
                <?php
                // length validation
                if (isset($_SESSION['validation']['length-validation']['length-required'])) {
                    $lengthRequired = $_SESSION['validation']['length-validation']['length-required'];
                }
                ?>
                <p class="m-0 text-danger"><?php if (isset($lengthRequired)) {
                                                echo $lengthRequired;
                                            } ?></p>
                <!-- ================================================================================= -->
                <input class="form-control <?php if (isset($_SESSION['old-values']['width']) && !empty($_SESSION['old-values']['width'])) {
                                                echo "is-valid";
                                            } elseif (isset($_SESSION['validation']['width-validation'])) {
                                                echo "is-invalid";
                                            } ?> my-2" name="width" id="width" placeholder="Width (CM)" value="<?php
                                                                                                                // get submitted value if it's valid
                                                                                                                if (isset($_SESSION['old-values']['width'])) {
                                                                                                                    echo $_SESSION['old-values']['width'];
                                                                                                                } else {
                                                                                                                    echo "";
                                                                                                                } ?>">
                <?php
                // width validation
                if (isset($_SESSION['validation']['width-validation']['width-required'])) {
                    $widthRequired = $_SESSION['validation']['width-validation']['width-required'];
                }
                ?>
                <p class="m-0 text-danger"><?php if (isset($widthRequired)) {
                                                echo $widthRequired;
                                            } ?></p>
                <!-- ================================================================================= -->
                <input class="form-control <?php if (isset($_SESSION['old-values']['height']) && !empty($_SESSION['old-values']['height'])) {
                                                echo "is-valid";
                                            } elseif (isset($_SESSION['validation']['height-validation'])) {
                                                echo "is-invalid";
                                            } ?> my-2" name="height" id="height" placeholder="Height (CM)" value="<?php
                                                                                                                    // get submitted value if it's valid
                                                                                                                    if (isset($_SESSION['old-values']['height'])) {
                                                                                                                        echo $_SESSION['old-values']['height'];
                                                                                                                    } else {
                                                                                                                        echo "";
                                                                                                                    } ?>">
                <?php
                // height validation
                if (isset($_SESSION['validation']['height-validation']['height-required'])) {
                    $heightRequired = $_SESSION['validation']['height-validation']['height-required'];
                }
                ?>
                <p class="m-0 text-danger"><?php if (isset($heightRequired)) {
                                                echo $heightRequired;
                                            } ?></p>
                <p class="text-muted">Please provide dimensions in LxWxH Format</p>
            </div>
            <!-- end option furniture -->
            <!-- option book -->
            <div class="form-group show-hide" id="book">
                <input class="form-control <?php if (isset($_SESSION['old-values']['weight']) && !empty($_SESSION['old-values']['weight'])) {
                                                echo "is-valid";
                                            } elseif (isset($_SESSION['validation']['weight-validation'])) {
                                                echo "is-invalid";
                                            } ?>" name="weight" id="weight" placeholder="weight (KG)" value="<?php
                                                                                                                // get submitted value if it's valid
                                                                                                                if (isset($_SESSION['old-values']['weight'])) {
                                                                                                                    echo $_SESSION['old-values']['weight'];
                                                                                                                } else {
                                                                                                                    echo "";
                                                                                                                } ?>">
                <p class="text-muted">Please provide weight in KG</p>
                <?php
                // weight validation
                if (isset($_SESSION['validation']['weight-validation']['weight-required'])) {
                    $weightRequired = $_SESSION['validation']['weight-validation']['weight-required'];
                }
                ?>
                <p class="m-0 text-danger"><?php if (isset($weightRequired)) {
                                                echo $weightRequired;
                                            } ?></p>
            </div>
            <!-- end option book -->
        </form>
    </div>
    <!-- end form -->
</div>
<?php
include_once "layouts/footer.php";
?>