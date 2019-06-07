<?php

namespace App\Repository\Read;

use App\Domain\Exception\ShapeNotFoundException;
use App\Repository\View\DiscListView;
use App\Repository\View\DiscView;
use App\Repository\View\ShapeListView;
use Doctrine\DBAL\Connection;
use App\Repository\View\ShapeView;

class DbalDiscReadRepository implements DbalReadRepository
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder
            ->select('count(d.id)')
            ->from('disc', 'd');

        return $this->connection->fetchColumn($queryBuilder->getSQL(), $queryBuilder->getParameters());
    }

    /**
     * @param int $shapeId
     * @return ShapeView|null
     * @throws ShapeNotFoundException
     */
    public function getById(int $shapeId) : ?ShapeView
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder
            ->select('d.id', 'd.r')
            ->from('disc', 'd')
            ->where('d.id = :discId')
            ->setParameter('discId', $shapeId);

        $discData = $this->connection->fetchAssoc($queryBuilder->getSQL(), $queryBuilder->getParameters());

        if(!$discData) {
            return null;
        }

        return new DiscView($discData['id'], $discData['r']);
    }

    /**
     * @return ShapeListView
     */
    public function getAll() : ShapeListView
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder
            ->select('d.id', 'd.r')
            ->from('disc', 'd');

        $discsData = $this->connection->fetchAll($queryBuilder->getSQL(), $queryBuilder->getParameters());

        $arrayOfDiscViews = array_map(function(array $discData) {
            return new DiscView($discData['id'], $discData['r']);
        }, $discsData);

        return new DiscListView($arrayOfDiscViews);
    }
}
