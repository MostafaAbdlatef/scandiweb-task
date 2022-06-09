<?php


include_once __DIR__ . "\../Interfaces/valuesInterface.php";

class Furniture implements valuesInterface
{
    private $length;
    private $width;
    private $height;


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


    public function getValue()
    {
        if (($this->length == 0) && ($this->width == 0) && ($this->height == 0)) {
            return null;
        } else {
            return "Dimension: $this->length x $this->width x $this->height";
        }
    }
}
