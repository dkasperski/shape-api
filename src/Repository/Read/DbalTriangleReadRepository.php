<?php

namespace App\Repository\Read;

use App\Domain\Exception\ShapeNotFoundException;
use App\Repository\View\ShapeListView;
use App\Repository\View\TriangleListView;
use App\Repository\View\TriangleView;
use Doctrine\DBAL\Connection;
use App\Repository\View\ShapeView;

class DbalTriangleReadRepository implements DbalReadRepository
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
            ->select('count(t.id)')
            ->from('triangle', 't');

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
            ->select('t.id', 't.a', 't.b', 't.c')
            ->from('triangle', 't')
            ->where('t.id = :triangleId')
            ->setParameter('triangleId', $shapeId);

        $triangleData = $this->connection->fetchAssoc($queryBuilder->getSQL(), $queryBuilder->getParameters());

        if(!$triangleData) {
            return null;
        }

        return new TriangleView($triangleData['id'], $triangleData['a'], $triangleData['b'], $triangleData['c']);
    }

    /**
     * @return ShapeListView
     */
    public function getAll() : ShapeListView
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder
            ->select('t.id', 't.a', 't.b', 't.c')
            ->from('triangle', 't');

        $triangleData = $this->connection->fetchAll($queryBuilder->getSQL(), $queryBuilder->getParameters());

        $arrayOfTriangleViews = array_map(function(array $triangleData) {
            return new TriangleView($triangleData['id'], $triangleData['a'], $triangleData['b'], $triangleData['c']);
        }, $triangleData);

        return new TriangleListView($arrayOfTriangleViews);
    }
}
