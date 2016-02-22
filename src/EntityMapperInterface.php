<?php
declare(strict_types = 1);
namespace Agares\MicroORM;

interface EntityMapperInterface
{
    /**
     * Map an array of fields into an instance of $className
     *
     * @param array $fields
     * @param string $className
     * @return mixed
     */
    public function map(array $fields, string $className);
}