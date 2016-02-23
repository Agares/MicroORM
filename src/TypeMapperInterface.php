<?php
declare(strict_types = 1);

namespace Agares\MicroORM;

interface TypeMapperInterface
{
    /**
     * Get value of entity field $fieldName, based on list of all $fields that were passed to mapper
     *
     * @param string $fieldName
     * @param array $fields
     *
     * @return mixed
     */
    public function fromString(string $fieldName, array $fields);
}