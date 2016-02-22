<?php
declare(strict_types = 1);

namespace Agares\MicroORMTests\Stubs;

class CustomType {}

class EntityWithCustomType
{
    public function getField() : CustomType
    {
        return null;
    }
}