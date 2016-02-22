<?php
declare(strict_types=1);
namespace Agares\MicroORM;

class EntityMapper implements EntityMapperInterface
{
    public function map(array $fields, string $className)
    {
        $entityReflection = new \ReflectionClass($className);

        $instance = $this->createEntityInstance($entityReflection);
        $this->mapEntityFields($fields, $entityReflection, $instance);

        return $instance;
    }

    private function createEntityInstance(\ReflectionClass $entityReflection)
    {
        $constructorReflection = $entityReflection->getConstructor();

        if ($constructorReflection === null || count($constructorReflection->getParameters()) === 0) {
            $instance = $entityReflection->newInstance();
        } else {
            $instance = $entityReflection->newInstanceWithoutConstructor();
        }

        return $instance;
    }

    private function mapEntityFields(array $fields, \ReflectionClass $entityReflection, $entityInstance)
    {
        foreach ($fields as $field => $value) {
            $fieldReflection = $entityReflection->getProperty($field);
            $fieldReflection->setAccessible(true);
            $fieldReflection->setValue($entityInstance, $value);
            $fieldReflection->setAccessible(false);
        }
    }
}