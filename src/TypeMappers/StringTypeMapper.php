<?php
declare(strict_types = 1);

namespace Agares\MicroORM\TypeMappers;

use Agares\MicroORM\TypeMapperInterface;

class StringTypeMapper implements TypeMapperInterface
{
    /**
     * {@inheritdoc}
     */
    public function fromString(string $value)
    {
        return $value;
    }
}