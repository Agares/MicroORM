<?php
declare(strict_types = 1);

namespace Agares\MicroORMTests\Stubs;

class EntityWithSingleDateTime
{
    private $field;

    public function getField() : \DateTime
    {
        return $this->field;
    }
}