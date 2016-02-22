<?php
declare(strict_types = 1);

namespace Agares\MicroORMTests\Stubs;

class EntityWithoutParameterlessConstructor
{
    private $field;

    public function __construct($field)
    {
        $this->field = $field;
    }

    public function getField()
    {
        return $this->field;
    }
}