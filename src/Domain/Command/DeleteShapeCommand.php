<?php

namespace App\Domain\Command;

class DeleteShapeCommand
{
    /**
     * @var string
     */
    private $shapeSlug;

    /**
     * @var string
     */
    private $id;

    /**
     * @param string $shapeSlug
     * @param int $id
     */
    public function __construct(string $shapeSlug, int $id)
    {
        $this->shapeSlug = $shapeSlug;
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getShapeSlug() : string
    {
        return $this->shapeSlug;
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }
}