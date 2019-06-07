<?php

namespace App\Domain\QueryHandler;

use App\Domain\Query\GetShapeListQuery;
use App\Repository\Factory\RepositoryFactory;
use App\Repository\Read\DbalReadRepository;
use App\Repository\View\ShapeListView;

class GetShapeListQueryHandler implements GetShapeListQueryHandlerInterface
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
     * @param GetShapeListQuery $getShapeListQuery
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @return \App\Repository\View\ShapeListView
     */
    public function __invoke(GetShapeListQuery $getShapeListQuery) : ShapeListView
    {
        /**
         * @var $dbalShapeReadRepository DbalReadRepository
         */
        $dbalShapeReadRepository = $this->repositoryFactory->getDbal($getShapeListQuery->getShapeSlug());
        return $dbalShapeReadRepository->getAll();
    }
}