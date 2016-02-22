<?php
declare(strict_types = 1);

namespace Agares\MicroORM;

class PDODbAdapter implements DatabaseAdapterInterface
{
    /** @var \PDO */
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /**
     * {@inheritdoc}
    */
    public function executeCommand(string $command, array $parameters = array())
    {
        $this->executeParameterisedQuery($command, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function executeQuery(string $query, array $parameters = array()) : array
    {
        $statement = $this->executeParameterisedQuery($query, $parameters);

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    private function executeParameterisedQuery($query, array $parameters) : \PDOStatement
    {
        $statement = $this->pdo->prepare($query);

        foreach($parameters as $name => $value) {
            $statement->bindValue($name, $value);
        }

        $statement->execute();

        return $statement;
    }
}