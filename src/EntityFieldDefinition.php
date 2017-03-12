<?php
declare(strict_types = 1);

namespace Agares\MicroORM;

final class EntityFieldDefinition
{
    /**
     * @var string
     */
    private $typeName;

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $fieldName;

    public function __construct(string $fieldName, string $name, string $typeName)
    {
        $this->name = $name;
        $this->typeName = $typeName;
        $this->fieldName = $fieldName;
    }

    public function getTypeName() : string
    {
        return $this->typeName;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getFieldName() : string
    {
        return $this->fieldName;
    }
}