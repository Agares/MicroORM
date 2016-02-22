<?php
declare(strict_types = 1);

namespace Agares\MicroORMTests\Stubs;

use Agares\MicroORM\DatabaseAdapterInterface;

class StubDatabaseAdapter implements DatabaseAdapterInterface
{
    const ENTITY_WITH_SINGLE_FIELD = 'A';

    /**
     * @var string
     */
    private $lastCommand = '';

    /**
     * @var array
     */
    private $lastCommandParameters = array();

    /**
     * @var array
     */
    private $lastQueryParameters = array();

    public function executeCommand(string $command, array $parameters = array())
    {
        $this->lastCommand = $command;
        $this->lastCommandParameters = $parameters;
    }

    public function executeQuery(string $query, array $parameters = array()) : array
    {
        $this->lastQueryParameters = $parameters;

        switch($query)
        {
            case self::ENTITY_WITH_SINGLE_FIELD:
                return [['field' => 'test']];
                break;
            default:
                throw new \RuntimeException(sprintf('Query %s is not implemented', $query));
        }
    }

    public function getLastCommand() : string
    {
        return $this->lastCommand;
    }

    public function getLastCommandParameters() : array
    {
        return $this->lastCommandParameters;
    }

    public function getLastQueryParameters()
    {
        return $this->lastQueryParameters;
    }
}