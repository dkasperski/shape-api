<?php

namespace App\Domain\QueryHandler;

use App\Domain\Query\GetShapeQuery;
use App\Repository\Factory\RepositoryFactory;
use App\Repository\Read\DbalReadRepository;
use App\Repository\View\ShapeView;

class GetShapeQueryHandler implements GetShapeQueryHandlerInterface
{
    /**
     * @var RepositoryFactory
     */
    private $repositoryFactory;

    /**
     * @param RepositoryFactory $repositoryFactory
     */
    public function __construct(RepositoryFactory $repositoryFactory)
    {
        $this->repositoryFactory = $repositoryFactory;
    }

    /**
     * @param GetShapeQuery $getShapeQuery
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @return \App\Repository\View\ShapeView|null
     */
    public function __invoke(GetShapeQuery $getShapeQuery) : ?ShapeView
    {
        /**
         * @var $dbalShapeReadRepository DbalReadRepository
         */
        $dbalShapeReadRepository = $this->repositoryFactory->getDbal($getShapeQuery->getShapeSlug());
        return $dbalShapeReadRepository->getById($getShapeQuery->getId());
    }
}