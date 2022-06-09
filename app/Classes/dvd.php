<?php


include_once __DIR__ . "\../Interfaces/valuesInterface.php";

class dvd implements valuesInterface
{
    private $size;


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

    public function getValue()
    {
        if ($this->size == 0) {
            return null;
        } else {
            return "Size: $this->size MB";
        }
    }
}
