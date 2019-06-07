<?php

namespace App\Repository\Write;

use App\Entity\Shape\Shape;
use Doctrine\ORM\EntityManagerInterface;

class ShapeDoctrineWriteRepository implements DoctrineWriteRepository
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
    public function save(Shape $shape) : bool
    {
        try {
            $this->em->persist($shape);
            $this->em->flush();
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }
}