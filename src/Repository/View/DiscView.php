<?php

namespace App\Repository\View;

class DiscView implements ShapeView
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var float
     */
    private $r;

    /**
     * @var string
     */
    private $type = 'disc';

    /**
     * @param int $id
     * @param float $r
     */
    public function __construct(int $id, float $r)
    {
        $this->id = $id;
        $this->r = $r;
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
    public function getR() : float
    {
        return $this->r;
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