<?php

namespace App\Model;

class Disc extends Shape {

    /**
     * @var float
     */
    private $r;

    /**
     * Disc constructor.
     * @param float $r
     */
    public function __construct($r)
    {
        $this->r = $r;
    }

    /**
     * @return float
     */
    public function getArea(): float
    {
       return $this->r * $this->r * pi();
    }
}