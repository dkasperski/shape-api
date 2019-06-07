<?php

namespace App\Repository\View;

class RectangleView implements ShapeView
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var float
     */
    private $a;

    /**
     * @var float
     */
    private $b;

    /**
     * @var string
     */
    private $type = 'rectangle';

    /**
     * @param int $id
     * @param float $a
     * @param float $b
     */
    public function __construct(int $id, float $a, float $b)
    {
        $this->id = $id;
        $this->a = $a;
        $this->b = $b;
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getA() : float
    {
        return $this->a;
    }

    /**
     * @return float
     */
    public function getB() : float
    {
        return $this->b;
    }

    /**
     * @return string
     */
    public function getType() : string
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return call_user_func('get_object_vars', $this);
    }
}