<?php
declare(strict_types = 1);

namespace Agares\MicroORM;


class EntityDefinitionCreator
{
    public function create($className) : EntityDefinition
    {
        $entityReflection = new \ReflectionClass($className);
        $methods = $entityReflection->getMethods(\ReflectionMethod::IS_PUBLIC);

        $entityDefinition = new EntityDefinition($className);
        foreach($methods as $method) {
            $methodName = $method->getName();

            if(!strpos($methodName, 'get') === 0) {
                continue;
            }

            $fieldName = lcfirst(substr($methodName, 3));
            $fieldType = $method->getReturnType() === NULL ? 'string' : (string)$method->getReturnType();

            $entityDefinition->addField(new EntityFieldDefinition($fieldName, $fieldType));
        }

        return $entityDefinition;
    }
}