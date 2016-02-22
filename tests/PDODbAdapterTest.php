<?php
declare(strict_types = 1);

namespace Agares\MicroORMTests;

use Agares\MicroORM\PDODbAdapter;

class PDODbAdapterTest extends \PHPUnit_Framework_TestCase
{
    /** @var  PDODbAdapter */
    private $adapter;

    /** @var  \PDO */
    private $pdo;

    public function setUp()
    {
        $this->pdo = new \PDO('sqlite::memory:');
        $this->adapter = new PDODbAdapter($this->pdo);

        $this->pdo->exec('CREATE TABLE test (col int not null)');
    }

    public function testCanExecuteParameterlessQuery()
    {
        $result = $this->adapter->executeQuery('SELECT 1 AS field');

        $this->assertEquals([['field' => 1]], $result);
    }

    public function testCanBindParametersForQuery()
    {
        $parameters = array(':p1' => 'A', ':p2' => 'B');

        $result = $this->adapter->executeQuery('SELECT :p1 AS param1, :p2 AS param2', $parameters);

        $this->assertEquals([['param1' => 'A', 'param2' => 'B']], $result);
    }

    public function testCanExecuteParameterlessCommand()
    {
        $this->adapter->executeCommand('INSERT INTO test (col) VALUES(1)');

        $this->assertEquals(1, $this->pdo->query('SELECT col FROM test')->fetch(\PDO::FETCH_COLUMN));
    }

    public function testCanBindParametersForCommand()
    {
        $parameters = [':col' => 22];

        $this->adapter->executeCommand('INSERT INTO test (col) VALUES (:col)', $parameters);

        $this->assertEquals(22, $this->pdo->query('SELECT col FROM test')->fetch(\PDO::FETCH_COLUMN));
    }
}