<?php
declare(strict_types = 1);

namespace Agares\MicroORMTests\Stubs;

class EntityWithSingleInt
{
    private $field;

    public function getField() : int
    {
        return $this->field;
    }
}