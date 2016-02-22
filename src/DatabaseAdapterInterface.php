<?php
declare(strict_types = 1);

namespace Agares\MicroORM;

interface DatabaseAdapterInterface
{
    public function executeCommand($command, array $parameters = array());
    public function executeQuery($query, array $parameters = array()) : array;
}