<?php
declare(strict_types = 1);
namespace Agares\MicroORM;

interface EntityMapperInterface
{
    /**
     * Map an array of fields into an instance of entity described by $entityDefinition
     *
     * @param array $fields
     * @param EntityDefinition $entityDefinition
     *
     * @return mixed
     */
    public function map(array $fields, EntityDefinition $entityDefinition);
}