<?php
declare(strict_types = 1);

namespace Agares\MicroORM;


class EntityDefinitionCreator
{
    public function create($className) : array
    {
        $entityReflection = new \ReflectionClass($className);
        $methods = $entityReflection->getMethods(\ReflectionMethod::IS_PUBLIC);

        $entityFields = [];
        foreach($methods as $method) {
            $methodName = $method->getName();

            if(!strpos($methodName, 'get') === 0) {
                continue;
            }

            $entityFields[lcfirst(substr($methodName, 3))] = [
                'type' => $method->getReturnType() === NULL ? 'string' : (string)$method->getReturnType()
            ];
        }

        return ['fields' => $entityFields, 'class_name' => $className];
    }
}