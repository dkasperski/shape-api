<?php

namespace App\Repository\View;

class TriangleView implements ShapeView
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
     * @var float
     */
    private $c;

    /**
     * @var string
     */
    private $type = 'triangle';

    /**
     * @param int $id
     * @param float $a
     * @param float $b
     * @param float $c
     */
    public function __construct(int $id, float $a, float $b, float $c)
    {
        $this->id = $id;
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
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
     * @return float
     */
    public function getC() : float
    {
        return $this->c;
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