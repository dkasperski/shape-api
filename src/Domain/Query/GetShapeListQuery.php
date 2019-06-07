<?php

namespace App\Domain\Query;

class GetShapeListQuery
{
    /**
     * @var string
     */
    private $shapeSlug;

    /**
     * @param string $shapeSlug
     */
    public function __construct(string $shapeSlug)
    {
        $this->shapeSlug = $shapeSlug;
    }

    /**
     * @return string
     */
    public function getShapeSlug() : string
    {
        return $this->shapeSlug;
    }
}