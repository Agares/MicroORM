<?php
declare(strict_types=1);
namespace Agares\MicroORM;

class EntityMapper
{
    public function map(array $array, string $className)
    {
        $entityReflection = new \ReflectionClass($className);

        $instance = $this->createEntityInstance($entityReflection);
        $this->mapEntityFields($array, $entityReflection, $instance);

        return $instance;
    }

    public function createEntityInstance(\ReflectionClass $entityReflection)
    {
        $constructorReflection = $entityReflection->getConstructor();

        if ($constructorReflection === null || count($constructorReflection->getParameters()) === 0) {
            $instance = $entityReflection->newInstance();
        } else {
            $instance = $entityReflection->newInstanceWithoutConstructor();
        }

        return $instance;
    }

    public function mapEntityFields(array $fields, \ReflectionClass $entityReflection, $entityInstance)
    {
        foreach ($fields as $field => $value) {
            $fieldReflection = $entityReflection->getProperty($field);
            $fieldReflection->setAccessible(true);
            $fieldReflection->setValue($entityInstance, $value);
            $fieldReflection->setAccessible(false);
        }
    }
}