<?php

namespace App\Model;

class Triangle extends Shape {

    /**
     * @var float
     */
    private $a;

    /**
     * @var float
     */
    private $b;

    /**
     * @var float
     */
    private $c;

    /**
     * Triangle constructor.
     * @param float $a
     * @param float $b
     * @param float $c
     */
    public function __construct($a, $b, $c)
    {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }

    /**
     * @return float
     */
    public function getArea(): float
    {
        $circuit = $this->getCircuit();
        return sqrt($circuit * ($circuit - $this->a) * ($circuit - $this->b) * ($circuit - $this->c));
    }

    /**
     * @return float
     */
    private function getCircuit(): float
    {
        return $this->a + $this->b + $this->c;
    }
}