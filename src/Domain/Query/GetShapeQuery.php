<?php

namespace App\Domain\Query;

class GetShapeQuery
{
    /**
     * @var string
     */
    private $shapeSlug;

    /**
     * @var int
     */
    private $id;

    /**
     * @param string $shapeSlug
     * @param int|null $id
     */
    public function __construct(string $shapeSlug, int $id = null)
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
     * @return int|null
     */
    public function getId(): ? int
    {
        return $this->id;
    }
}