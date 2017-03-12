<?php

declare(strict_types = 1);

namespace Agares\MicroORM;

class EntityDefinitionCreator implements EntityDefinitionCreatorInterface
{
    /**
     * @var FieldNameMapperInterface
     */
    private $fieldNameMapper;

    public function __construct(FieldNameMapperInterface $fieldNameMapper)
    {
        $this->fieldNameMapper = $fieldNameMapper;
    }

    public function create(string $className) : EntityDefinition
    {
        $entityReflection = new \ReflectionClass($className);
        $methods = $entityReflection->getMethods(\ReflectionMethod::IS_PUBLIC);

        $entityDefinition = new EntityDefinition($className);
        foreach ($methods as $method) {
            $methodName = $method->getName();

            if (strpos($methodName, 'get') !== 0) {
                continue;
            }

            $fieldName = $this->fieldNameMapper->map($methodName);
            $fieldType = $method->getReturnType() === NULL ? 'string' : (string) $method->getReturnType();

            $entityDefinition->addField(new EntityFieldDefinition(lcfirst(substr($methodName, 3)), $fieldName, $fieldType));
        }

        return $entityDefinition;
    }
}