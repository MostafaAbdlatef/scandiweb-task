<?php

session_start();

include_once __DIR__ . "\../Models/Product.php";

class ProductsRequest extends Product
{
    private $required = "*Please, submit required data";
    private $invalid = "*Please, provide the data of indicated type";
    private $exists = "*This value already exists";
    private $errors = [];


    /**
     * Get the value of errors
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Set the value of errors
     *
     * @return  self
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;

        return $this;
    }
    //Very important============================
    public function fieldRequired()
    {
        foreach ($_POST as $key => $value) {
            if (empty($value)) {
                $this->errors["$key-required"] = $this->required;
            }
        }
        return $this->errors;
    }
    // ==========================================
    public function validateSku()
    {
        $pattern = "/^[a-zA-Z]+[a-zA-Z0-9._]+$/";
        if ($this->skuExists()) {
            $this->errors['sku-exists'] = $this->exists;
        } elseif (!preg_match($pattern, $this->getSku())) {
            $this->errors['sku-invalid'] = $this->invalid;
        }
        return $this->errors;
    }
    public function validateName()
    {
        $pattern = "/^[a-zA-Z][a-zA-Z ]*$/";
        if (!preg_match($pattern, $this->getName())) {
            $this->errors['name-invalid'] = $this->invalid;
        }
        return $this->errors;
    }
    public function validatePrice()
    {
        $pattern = "/^[0-9]+(\.[0-9]{2})?$/";
        if (!preg_match($pattern, $this->getPrice())) {
            $this->errors['price-invalid'] = $this->invalid;
        }
        return $this->errors;
    }
}

if ($_POST) {


    $registeration = new ProductsRequest;
    //Setting values of object from request
    $registeration->setSku($_POST['sku']);
    $registeration->setName($_POST['name']);
    $registeration->setPrice($_POST['price']);
    $registeration->setType($_POST['product-type']);
    isset($_POST['size']) ? $registeration->setSize($_POST['size']) : null;
    isset($_POST['length']) ? $registeration->setLength($_POST['length']) : null;
    isset($_POST['width']) ? $registeration->setWidth($_POST['width']) : null;
    isset($_POST['height']) ? $registeration->setHeight($_POST['height']) : null;
    isset($_POST['weight']) ? $registeration->setWeight($_POST['weight']) : null;
    
    $_SESSION['old-values'] = $_POST;
    //Experiment
    $requiredValidation = $registeration->fieldRequired();
    if ($requiredValidation) {

        foreach ($requiredValidation as $key => $value) {
            $fieldName = substr($key, 0, strpos($key, '-'));
            $_SESSION['validation']["$fieldName-validation"]["$key"] = $value;
        }

        $skuValidation = $registeration->validateSku();
        if ($skuValidation) {
            foreach ($skuValidation as $key => $value) {
                if ($key == 'sku-exists') {
                    $_SESSION['validation']['sku-validation']['sku-exists'] = $value;
                } elseif ($key == 'sku-invalid') {
                    $_SESSION['validation']['sku-validation']['sku-invalid'] = $value;
                }
            }
            header('location:../../add-product.php');
        }
        $nameValidation = $registeration->validateName();
        if ($nameValidation) {
            foreach ($nameValidation as $key => $value) {
                if ($key == 'name-invalid') {
                    $_SESSION['validation']['name-validation']['name-invalid'] = $value;
                }
            }
            header('location:../../add-product.php');
        }
    } else {
        $registeration->create();
        unset($_SESSION['old-values']);
        header('location:../../index.php');
    }
}
