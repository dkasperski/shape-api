<?php

namespace App\Domain\CommandHandler;

use App\Domain\Command\UpdateShapeCommand;
use App\Domain\Exception\ShapeNotFoundException;
use App\Repository\Factory\RepositoryFactory;
use App\Repository\Read\DoctrineReadRepository;
use App\Repository\Write\DoctrineWriteRepository;

class UpdateShapeCommandHandler
{
    /**
     * @var RepositoryFactory
     */
    private $repositoryFactory;

    /**
     * @var DoctrineWriteRepository
     */
    private $doctrineWriteRepository;

    /**
     * @param RepositoryFactory $repositoryFactory
     * @param DoctrineWriteRepository $doctrineWriteRepository
     */
    public function __construct(
        RepositoryFactory $repositoryFactory,
        DoctrineWriteRepository $doctrineWriteRepository
    ) {
        $this->repositoryFactory = $repositoryFactory;
        $this->doctrineWriteRepository = $doctrineWriteRepository;
    }

    /**
     * @param UpdateShapeCommand $updateShapeCommand
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function __invoke(UpdateShapeCommand $updateShapeCommand)
    {
        $shapeData = $updateShapeCommand->getData()['data'];
        $shapeType = $updateShapeCommand->getData()['type'];
        /**
         * @var $doctrineShapeReadRepository DoctrineReadRepository
         */
        $doctrineShapeReadRepository = $this->repositoryFactory->getDoctrine($shapeType);
        $shape = $doctrineShapeReadRepository->getById($updateShapeCommand->getId());

        if (!$shape) {
            throw new ShapeNotFoundException('Shape not found');
        }

        foreach ($shapeData as $propertyName => $propertyValue) {
            $shape->$propertyName = $propertyValue;
        }

        $this->doctrineWriteRepository->save($shape);
    }
}