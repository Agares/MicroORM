<?php
declare(strict_types = 1);

namespace Agares\MicroORM\TypeMappers;

use Agares\MicroORM\TypeMapperInterface;

class IntegerTypeMapper implements TypeMapperInterface
{
    /**
     * {@inheritdoc}
     */
    public function fromString(string $fieldName, array $fields)
    {
        return (int)$fields[$fieldName];
    }
}