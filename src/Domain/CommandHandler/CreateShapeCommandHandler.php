<?php

namespace App\Domain\CommandHandler;

use App\Domain\Command\CreateShapeCommand;
use App\Domain\Exception\ShapeNotFoundException;
use App\Entity\Shape\ShapeFactory;
use App\Repository\Write\DoctrineWriteRepository;

class CreateShapeCommandHandler
{
    /**
     * @var ShapeFactory
     */
    private $shapeFactory;

    /**
     * @var DoctrineWriteRepository
     */
    private $doctrineWriteRepository;

    /**
     * @param ShapeFactory $shapeFactory
     * @param DoctrineWriteRepository $doctrineWriteRepository
     */
    public function __construct(
        ShapeFactory $shapeFactory,
        DoctrineWriteRepository $doctrineWriteRepository
    ) {
        $this->shapeFactory = $shapeFactory;
        $this->doctrineWriteRepository = $doctrineWriteRepository;
    }

    /**
     * @param CreateShapeCommand $createShapeCommand
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function __invoke(CreateShapeCommand $createShapeCommand)
    {
        $shape = $this->shapeFactory->create($createShapeCommand);

        if (!$shape) {
            throw new ShapeNotFoundException('Shape not found');
        }

        $this->doctrineWriteRepository->save($shape);
    }
}