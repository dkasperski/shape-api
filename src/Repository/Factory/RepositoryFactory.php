<?php

namespace App\Repository\Factory;

use App\Repository\Exception\RepositoryNotFoundException;
use App\Repository\Read\DbalReadRepository;
use App\Repository\Read\DoctrineReadRepository;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;

class RepositoryFactory
{
    const DBAL_REPOSITORY_CLASS_NAME_PATTERN = "Dbal%sReadRepository";

    const DOCTRINE_REPOSITORY_CLASS_NAME_PATTERN = "Doctrine%sReadRepository";

    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @param Connection $connection
     * @param EntityManagerInterface $em
     */
    public function __construct(Connection $connection, EntityManagerInterface $em)
    {
        $this->connection = $connection;
        $this->em = $em;
    }

    /**
     * @var DbalReadRepository
     */
    private $dbalRepository;

    /**
     * @var DoctrineReadRepository
     */
    private $doctrineRepository;

    /**
     * @param string $shapeSlug
     * @throws RepositoryNotFoundException
     */
    private function createDbal(string $shapeSlug)
    {
        $repositoryClassName = sprintf(self::DBAL_REPOSITORY_CLASS_NAME_PATTERN, ucfirst($shapeSlug));
        $repositoryNamespaceAndClassName = $this->getDbalRepositoryClassName($repositoryClassName);

        if(!class_exists($repositoryNamespaceAndClassName)) {
            throw new RepositoryNotFoundException();
        }

        $this->dbalRepository = new $repositoryNamespaceAndClassName($this->connection);
    }

    /**
     * @param string $shapeSlug
     * @throws RepositoryNotFoundException
     */
    private function createDoctrine(string $shapeSlug)
    {
        $repositoryClassName = sprintf(self::DOCTRINE_REPOSITORY_CLASS_NAME_PATTERN, ucfirst($shapeSlug));
        $repositoryNamespaceAndClassName = $this->getDoctrineRepositoryClassName($repositoryClassName);

        if(!class_exists($repositoryNamespaceAndClassName)) {
            throw new RepositoryNotFoundException();
        }

        $this->doctrineRepository = new $repositoryNamespaceAndClassName($this->em);
    }

    /**
     * @param string $repositoryClassName
     * @return string
     */
    private function getDbalRepositoryClassName(string $repositoryClassName): string
    {
        $dbalReadRepositoryNamespace = new \ReflectionClass(DbalReadRepository::class);
        return sprintf("%s\%s", $dbalReadRepositoryNamespace->getNamespaceName(), $repositoryClassName);
    }

    /**
     * @param string $repositoryClassName
     * @return string
     */
    private function getDoctrineRepositoryClassName(string $repositoryClassName): string
    {
        $doctrineReadRepositoryNamespace = new \ReflectionClass(DoctrineReadRepository::class);
        return sprintf("%s\%s", $doctrineReadRepositoryNamespace->getNamespaceName(), $repositoryClassName);
    }

    /**
     * @param string $shapeSlug
     * @return DbalReadRepository
     */
    public function getDbal(string $shapeSlug)
    {
        $this->createDbal($shapeSlug);
        return $this->dbalRepository;
    }

    /**
     * @param string $shapeSlug
     * @return DoctrineReadRepository
     */
    public function getDoctrine(string $shapeSlug)
    {
        $this->createDoctrine($shapeSlug);
        return $this->doctrineRepository;
    }
}