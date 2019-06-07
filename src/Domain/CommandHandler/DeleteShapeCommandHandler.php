<?php

namespace App\Domain\CommandHandler;

use App\Domain\Command\DeleteShapeCommand;
use App\Domain\Exception\ShapeNotFoundException;
use App\Repository\Delete\DoctrineDeleteRepository;
use App\Repository\Factory\RepositoryFactory;
use App\Repository\Read\DoctrineReadRepository;

class DeleteShapeCommandHandler
{
    /**
     * @var RepositoryFactory
     */
    private $repositoryFactory;

    /**
     * @var DoctrineDeleteRepository
     */
    private $doctrineDeleteRepository;

    /**
     * @param RepositoryFactory $repositoryFactory
     * @param DoctrineDeleteRepository $doctrineDeleteRepository
     */
    public function __construct(
        RepositoryFactory $repositoryFactory,
        DoctrineDeleteRepository $doctrineDeleteRepository
    ) {
        $this->repositoryFactory = $repositoryFactory;
        $this->doctrineDeleteRepository = $doctrineDeleteRepository;
    }

    /**
     * @param DeleteShapeCommand $deleteShapeCommand
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function __invoke(DeleteShapeCommand $deleteShapeCommand)
    {
        /**
         * @var $doctrineShapeReadRepository DoctrineReadRepository
         */
        $doctrineShapeReadRepository = $this->repositoryFactory->getDoctrine($deleteShapeCommand->getShapeSlug());
        $shape = $doctrineShapeReadRepository->getById($deleteShapeCommand->getId());

        if (!$shape) {
            throw new ShapeNotFoundException('Shape not found');
        }

        $this->doctrineDeleteRepository->remove($shape);
    }
}