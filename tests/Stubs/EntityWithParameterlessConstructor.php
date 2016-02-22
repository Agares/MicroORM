<?php
declare(strict_types = 1);

namespace Agares\MicroORMTests\Stubs;


class EntityWithParameterlessConstructor
{
    /**
     * @var bool
     */
    private $wasConstructorCalled = false;

    public function __construct()
    {
        $this->wasConstructorCalled = true;
    }

    public function wasConstructorCalled() : bool
    {
        return $this->wasConstructorCalled;
    }
}