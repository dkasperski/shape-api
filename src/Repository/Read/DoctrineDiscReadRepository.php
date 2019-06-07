<?php

namespace App\Repository\Read;

use App\Entity\Shape\Shape;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineDiscReadRepository implements DoctrineReadRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param int $shapeId
     * @return Shape|null
     */
    public function getById(int $shapeId): ?Shape
    {
        return $this->em->find('App\Entity\Shape\Disc', $shapeId);
    }
}