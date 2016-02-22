<?php
declare(strict_types = 1);

namespace Agares\MicroORMTests;

use Agares\MicroORM\EntityMapper;
use Agares\MicroORM\QueryAdapter;
use Agares\MicroORMTests\Stubs\EntityWithSingleString;
use Agares\MicroORMTests\Stubs\StubDatabaseAdapter;

class QueryAdapterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var QueryAdapter
     */
    private $queryAdapter;

    /**
     * @var StubDatabaseAdapter
     */
    private $dbAdapter;

    public function setUp()
    {
        $this->dbAdapter = new StubDatabaseAdapter();
        $this->queryAdapter = new QueryAdapter($this->dbAdapter, new EntityMapper());
    }

    public function testExecutesParameterlessCommand()
    {
        $command = 'SELECT 1';

        $this->queryAdapter->executeCommand($command);

        $this->assertEquals($command, $this->dbAdapter->getLastCommand());
    }

    public function testCanExecuteCommandWithParameters()
    {
        $command = 'SELECT 1 = :param';
        $parameters = array(':param' => 2);

        $this->queryAdapter->executeCommand($command, $parameters);

        $this->assertEquals($command, $this->dbAdapter->getLastCommand());
        $this->assertEquals($parameters, $this->dbAdapter->getLastCommandParameters());
    }

    public function testCanMapResultOfAQuery()
    {
        /** @var EntityWithSingleString $result */
        $result = $this->queryAdapter->executeQuery(StubDatabaseAdapter::ENTITY_WITH_SINGLE_FIELD, EntityWithSingleString::class);

        $this->assertEquals('test', $result[0]->getField());
    }

    public function testPassesParametersToTheQuery()
    {
        $parameters = array(':field' => 2);
        $this->queryAdapter->executeQuery(StubDatabaseAdapter::ENTITY_WITH_SINGLE_FIELD, EntityWithSingleString::class, $parameters);

        $this->assertEquals($parameters, $this->dbAdapter->getLastQueryParameters());
    }
}