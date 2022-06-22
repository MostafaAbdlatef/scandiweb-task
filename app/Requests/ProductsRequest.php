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

    public function validateSku()
    {
        if (empty($this->getSku())) {
            return $this->errors['sku_error'] = $this->required;
        } elseif (!preg_match("/^[a-zA-Z]+[a-zA-Z0-9._]+$/", $this->getSku())) {
            return $this->errors['sku_error'] = $this->invalid;
        } elseif ($this->skuExists()) {
            return $this->errors['sku_error'] = $this->exists;
        }
    }

    public function validateName()
    {
        if (empty($this->getName())) {
            return $this->errors['name_error'] = $this->required;
        } elseif (!preg_match("/^[a-zA-Z]+[a-zA-Z0-9._.\s]+$/", $this->getName())) {
            return $this->errors['name_error'] = $this->invalid;
        }
    }

    public function validatePrice()
    {
        if (empty($this->getPrice())) {
            return $this->errors['price_error'] = $this->required;
        } elseif (!preg_match("/^[0-9]+(\.[0-9]{2})?$/", $this->getPrice())) {
            return $this->errors['price_error'] = $this->invalid;
        }
    }
    public function validateType()
    {
        if (empty($this->getType())) {
            return $this->errors['type_error'] = $this->required;
        }
    }
    public function validateSize()
    {
        if (empty($this->getSize())) {
            return $this->errors['size_error'] = $this->required;
        } elseif (!preg_match("/^[0-9]+([0-9]+)?$/", $this->getSize())) {
            return $this->errors['size_error'] = $this->invalid;
        }
    }
    public function validateLength()
    {
        if (empty($this->getLength())) {
            return $this->errors['length_error'] = $this->required;
        } elseif (!preg_match("/^[0-9]+(\.[0-9]{2})?$/", $this->getLength())) {
            return $this->errors['length_error'] = $this->invalid;
        }
    }
    public function validateWidth()
    {
        if (empty($this->getWidth())) {
            return $this->errors['width_error'] = $this->required;
        } elseif (!preg_match("/^[0-9]+(\.[0-9]{2})?$/", $this->getWidth())) {
            return $this->errors['width_error'] = $this->invalid;
        }
    }
    public function validateHeight()
    {
        if (empty($this->getHeight())) {
            return $this->errors['height_error'] = $this->required;
        } elseif (!preg_match("/^[0-9]+(\.[0-9]{2})?$/", $this->getHeight())) {
            return $this->errors['height_error'] = $this->invalid;
        }
    }
    public function validateWeight()
    {
        if (empty($this->getWeight())) {
            return $this->errors['weight_error'] = $this->required;
        } elseif (!preg_match("/^[0-9]+(\.[0-9]{2})?$/", $this->getWeight())) {
            return $this->errors['weight_error'] = $this->invalid;
        }
    }
}

// Save button
if ($_POST) {
    // Delete button 
    if (isset($_POST['delete-multi-prod'])) {
        if (empty($_POST['product-delete'])) {
            header('location:../../index.php');
        } else {
            $deleteProduct = new ProductsRequest;
            $all_id = $_POST['product-delete'];
            $extract_id = implode(',', $all_id);
            $deleteProduct->setId($extract_id);
            $deleteProduct->delete();
            header('location:../../index.php');
        }
    } else {

        $registeration = new ProductsRequest;
        //Setting values of object from request
        $registeration->setSku($_POST['sku']);
        $registeration->setName($_POST['name']);
        $registeration->setPrice($_POST['price']);
        isset($_POST['type']) ? $registeration->setType($_POST['type']) : null;
        isset($_POST['size']) ? $registeration->setSize($_POST['size']) : $registeration->setSize(0);
        isset($_POST['length']) ? $registeration->setLength($_POST['length']) : $registeration->setLength(0);
        isset($_POST['width']) ? $registeration->setWidth($_POST['width']) : $registeration->setWidth(0);
        isset($_POST['height']) ? $registeration->setHeight($_POST['height']) : $registeration->setHeight(0);
        isset($_POST['weight']) ? $registeration->setWeight($_POST['weight']) : $registeration->setWeight(0);

        // validation
        $registeration->validateSku();
        $registeration->validateName();
        $registeration->validatePrice();
        $registeration->validateType();
        isset($_POST['size']) ? $registeration->validateSize() : null;
        isset($_POST['length']) ? $registeration->validateLength() : null;
        isset($_POST['width']) ? $registeration->validateWidth() : null;
        isset($_POST['height']) ? $registeration->validateHeight() : null;
        isset($_POST['weight']) ? $registeration->validateWeight() : null;

        // echo "<pre>";
        // print_r($registeration->getErrors());
        // echo "</pre>";
        if (count($registeration->getErrors()) == 0) {
            $registeration->create();
        }

        $output = $registeration->getErrors();
        echo json_encode($output);
    }
}
