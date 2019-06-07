<?php

namespace App\Repository\Read;

use App\Domain\Exception\ShapeNotFoundException;
use App\Repository\View\RectangleListView;
use App\Repository\View\RectangleView;
use App\Repository\View\ShapeListView;
use Doctrine\DBAL\Connection;
use App\Repository\View\ShapeView;

class DbalRectangleReadRepository implements DbalReadRepository
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
            ->select('count(r.id)')
            ->from('rectangle', 'r');

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
            ->select('r.id', 'r.a', 'r.b')
            ->from('rectangle', 'r')
            ->where('r.id = :rectangleId')
            ->setParameter('rectangleId', $shapeId);

        $rectangleData = $this->connection->fetchAssoc($queryBuilder->getSQL(), $queryBuilder->getParameters());

        if(!$rectangleData) {
            return null;
        }

        return new RectangleView($rectangleData['id'], $rectangleData['a'], $rectangleData['b']);
    }

    /**
     * @return ShapeListView
     */
    public function getAll() : ShapeListView
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder
            ->select('r.id', 'r.a', 'r.b')
            ->from('rectangle', 'r');

        $rectangleData = $this->connection->fetchAll($queryBuilder->getSQL(), $queryBuilder->getParameters());

        $arrayOfRectangleViews = array_map(function(array $rectangleData) {
            return new RectangleView($rectangleData['id'], $rectangleData['a'], $rectangleData['b']);
        }, $rectangleData);

        return new RectangleListView($arrayOfRectangleViews);
    }
}
