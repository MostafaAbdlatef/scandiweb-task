<?php

include_once __DIR__ . "\../database/DatabaseConnection.php";
include_once __DIR__ . "\../Interfaces/operationsInterface.php";



class Product extends DatabaseConnection implements operationsInterface
{

    private $id;
    private $sku;
    private $name;
    private $price;
    private $type;
    private $size;
    private $weight;
    private $length;
    private $width;
    private $height;


    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of sku
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Set the value of sku
     *
     * @return  self
     */
    public function setSku($sku)
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of size
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set the value of size
     *
     * @return  self
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get the value of weight
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set the value of weight
     *
     * @return  self
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }
    /**
     * Get the value of length
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set the value of length
     *
     * @return  self
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get the value of width
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set the value of width
     *
     * @return  self
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get the value of height
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set the value of height
     *
     * @return  self
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    // CRUD Operations

    //Create
    public function create()
    {
        $query = "INSERT INTO `products` 
        (`products`.`sku`,`products`.`name`,
        `products`.`price`,`products`.`type`,`products`.`size`,
        `products`.`length`,`products`.`width`,`products`.`height`,`products`.`weight`) 
        VALUES 
        ('$this->sku','$this->name',
        '$this->price','$this->type','$this->size',
        '$this->length','$this->width','$this->height','$this->weight')";
        return $this->runDML($query);
    }

    //Read
    public function read()
    {
        $query = "SELECT * FROM `products`";
        return $this->runDQL($query);
    }

    //Delete
    public function delete()
    {
        $query = "DELETE FROM `products` WHERE id IN($this->id)";
        return $this->runDML($query);
    }

    //Extra queries

    //Query to check if sku exists in Database

    public function getById()
    {
        $query = "SELECT * FROM `products` WHERE `products`.`id` = '$this->id'";
        return $this->runDQL($query);
    }

    public function skuExists()
    {
        $query = "SELECT * FROM `products` WHERE `products`.`sku` = '$this->sku'";
        return $this->runDQL($query);
    }
}
