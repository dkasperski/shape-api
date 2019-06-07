<?php

namespace App\Repository\Read;

use App\Entity\Shape\Shape;
use Doctrine\ORM\EntityManagerInterface;

interface DoctrineReadRepository
{
    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em);

    /**
     * @param int $shapeId
     * @return Shape|null
     */
    public function getById(int $shapeId) : ?Shape;
}