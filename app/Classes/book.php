<?php


include_once __DIR__ . "\../Interfaces/valuesInterface.php";

class book implements valuesInterface
{
    private $weight;
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
    public function getValue()
    {
        if ($this->weight == 0) {
            return null;
        } else {
            return "Weight: $this->weight KG";
        }
    }
}
