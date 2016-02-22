<?php
declare(strict_types = 1);

namespace Agares\MicroORM;


class EntityDefinition
{
    /**
     * @var EntityFieldDefinition[]
     */
    private $fields = array();

    /**
     * @var string
     */
    private $className;

    public function __construct(string $className)
    {
        $this->className = $className;
    }

    public function addField(EntityFieldDefinition $field)
    {
        $this->fields[$field->getName()] = $field;
    }

    public function getClassName() : string
    {
        return $this->className;
    }

    /**
     * @return EntityFieldDefinition[]
     */
    public function getFields() : array
    {
        return $this->fields;
    }
}