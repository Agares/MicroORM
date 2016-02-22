<?php
declare(strict_types = 1);

namespace Agares\MicroORM;

class EntityFieldDefinition
{
    /**
     * @var string
     */
    private $typeName;

    /**
     * @var string
     */
    private $name;

    public function __construct(string $name, string $typeName)
    {
        $this->name = $name;
        $this->typeName = $typeName;
    }

    public function getTypeName() : string
    {
        return $this->typeName;
    }

    public function getName() : string
    {
        return $this->name;
    }
}