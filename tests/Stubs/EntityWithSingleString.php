<?php
declare(strict_types = 1);

namespace Agares\MicroORMTests\Stubs;


class EntityWithSingleString
{
    private $field;

    public function getField() : string
    {
        return $this->field;
    }
}