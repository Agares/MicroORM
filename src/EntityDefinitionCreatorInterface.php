<?php
declare(strict_types = 1);

namespace Agares\MicroORM;

interface EntityDefinitionCreatorInterface
{
    /**
     * Create an entity definition for $className
     *
     * @param string $className
     * @return EntityDefinition
     */
    public function create(string $className) : EntityDefinition;
}