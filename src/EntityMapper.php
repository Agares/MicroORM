<?php
declare(strict_types = 1);
namespace Agares\MicroORM;

use Agares\MicroORM\TypeMappers\IntegerTypeMapper;
use Agares\MicroORM\TypeMappers\StringTypeMapper;

final class EntityMapper implements EntityMapperInterface
{
    /** @var TypeMapperInterface[] */
    private $typeMappers = array();

    public function __construct(array $typeMappers = null)
    {
        if ($typeMappers == null) {
            $typeMappers = [
                'string' => new StringTypeMapper(),
                'int' => new IntegerTypeMapper()
            ];
        }

        $this->typeMappers = $typeMappers;
    }

    public function map(array $fields, EntityDefinition $entityDefinition)
    {
        $entityReflection = new \ReflectionClass($entityDefinition->getClassName());

        $instance = $this->createEntityInstance($entityReflection);
        $this->mapEntityFields($fields, $entityReflection, $instance, $entityDefinition->getFields());

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

    /**
     * @param array $fields
     * @param \ReflectionClass $entityReflection
     * @param mixed $entityInstance
     * @param EntityFieldDefinition[] $fieldsDefinition
     *
     * @throws UnknownFieldTypeException
     */
    private function mapEntityFields(array $fields, \ReflectionClass $entityReflection, $entityInstance, array $fieldsDefinition)
    {
        foreach ($fieldsDefinition as $fieldName => $definition) {
            $typeName = $definition->getTypeName();

            if (!isset($this->typeMappers[$typeName])) {
                throw new UnknownFieldTypeException($typeName);
            }

            $fieldReflection = $entityReflection->getProperty($definition->getFieldName());
            $fieldReflection->setAccessible(true);
            $fieldReflection->setValue($entityInstance, $this->typeMappers[$typeName]->fromString($fieldName, $fields));
            $fieldReflection->setAccessible(false);
        }
    }
}