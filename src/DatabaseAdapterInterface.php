<?php
declare(strict_types = 1);

namespace Agares\MicroORM;

interface DatabaseAdapterInterface
{
    /**
     * Execute a command (i.e. something that does NOT return a result).
     *
     * @param string $command
     * @param array $parameters
     *
     * @return void
     */
    public function executeCommand(string $command, array $parameters = array());

    /**
     * Execute a query (i.e. something that DOES return a result).
     *
     * @param string $query
     * @param array $parameters
     *
     * @return array
     */
    public function executeQuery(string $query, array $parameters = array()) : array;
}