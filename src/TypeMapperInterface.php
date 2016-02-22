<?php
declare(strict_types = 1);

namespace Agares\MicroORM;

interface TypeMapperInterface
{
    /**
     * Convert $value to the type that this mapper maps to.
     *
     * @param string $value
     * @return mixed
     */
    public function fromString(string $value);
}