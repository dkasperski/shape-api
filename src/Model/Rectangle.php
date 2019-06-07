<?php

namespace App\Model;

class Rectangle extends Shape {

    /**
     * @var float
     */
    private $a;

    /**
     * @var float
     */
    private $b;

    /**
     * Rectangle constructor.
     * @param float $a
     * @param float $b
     */
    public function __construct($a, $b)
    {
        $this->a = $a;
        $this->b = $b;
    }

    /**
     * @return float
     */
    public function getArea(): float
    {
       return $this->a * $this->b;
    }
}