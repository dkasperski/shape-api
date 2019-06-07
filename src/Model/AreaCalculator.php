<?php

namespace App\Model;

class AreaCalculator {

    /**
     * @param Shape $shape
     * @return float
     */
    public function calculateArea(Shape $shape): float
    {
        return $shape->getArea();
    }
}