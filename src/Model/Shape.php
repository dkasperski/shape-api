<?php

namespace App\Model;

/**
 * Class Shape
 * @package App\Model
 */
abstract class Shape {

    /**
     * @return float
     */
    abstract public function getArea(): float;
}