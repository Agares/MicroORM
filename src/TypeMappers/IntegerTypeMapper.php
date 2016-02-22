<?php
declare(strict_types = 1);

namespace Agares\MicroORM\TypeMappers;

use Agares\MicroORM\TypeMapperInterface;

class IntegerTypeMapper implements TypeMapperInterface
{
    /**
     * {@inheritdoc}
     */
    public function fromString(string $value)
    {
        return (int)$value;
    }
}