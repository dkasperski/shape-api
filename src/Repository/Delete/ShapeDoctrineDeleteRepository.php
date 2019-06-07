<?php

namespace App\Repository\Delete;

use App\Entity\Shape\Shape;
use Doctrine\ORM\EntityManagerInterface;

class ShapeDoctrineDeleteRepository implements DoctrineDeleteRepository
{
    /**
     * @var EntityManagerInterface $em
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
     * @param Shape $shape
     * @return bool
     */
    public function remove(Shape $shape): bool
    {
        try {
            $this->em->remove($shape);
            $this->em->flush();
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }
}