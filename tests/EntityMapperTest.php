<?php
declare(strict_types=1);

namespace Agares\MicroORMTests;

use Agares\MicroORM\EntityDefinitionCreator;
use Agares\MicroORM\EntityMapper;
use Agares\MicroORM\FieldNameMappers\StripGet;
use Agares\MicroORM\FieldNameMappers\ToUnderscores;
use Agares\MicroORMTests\Stubs\EmptyEntity;
use Agares\MicroORMTests\Stubs\EntityWithComplexFieldName;
use Agares\MicroORMTests\Stubs\EntityWithCustomType;
use Agares\MicroORMTests\Stubs\EntityWithoutParameterlessConstructor;
use Agares\MicroORMTests\Stubs\EntityWithParameterlessConstructor;
use Agares\MicroORMTests\Stubs\EntityWithSingleInt;
use Agares\MicroORMTests\Stubs\EntityWithSingleString;

class EntityMapperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EntityMapper
     */
    private $mapper;

    /**
     * @var EntityDefinitionCreator
     */
    private $definitionCreator;

    public function setUp()
    {
        $this->mapper = new EntityMapper();
        $this->definitionCreator = new EntityDefinitionCreator(new ToUnderscores());
    }

    public function testCanMapIntoTargetType()
    {
        $result = $this->mapper->map(array(), $this->definitionCreator->create(EmptyEntity::class));

        $this->assertInstanceOf(EmptyEntity::class, $result);
    }

    public function testCanMapPrivateStringField()
    {
        $fieldValue = 'test';

        /** @var EntityWithSingleString $result */
        $result = $this->mapper->map(array('field' => $fieldValue), $this->definitionCreator->create(EntityWithSingleString::class));

        $this->assertEquals($fieldValue, $result->getField());
    }

    public function testCanMapEntityWithoutParameterlessConstructor()
    {
        $fieldValue = 'test';

        /** @var EntityWithoutParameterlessConstructor $result */
        $result = $this->mapper->map(array('field' => $fieldValue), $this->definitionCreator->create(EntityWithoutParameterlessConstructor::class));

        $this->assertEquals($fieldValue, $result->getField());
    }

    public function testParameterlessConstructorIsExecuted()
    {
        /** @var EntityWithParameterlessConstructor $result */
        $result = $this->mapper->map(array(), $this->definitionCreator->create(EntityWithParameterlessConstructor::class));

        $this->assertTrue($result->wasConstructorCalled());
    }

    public function testCanMapAnIntegerFromString()
    {
        /** @var EntityWithSingleInt $result */
        $result = $this->mapper->map(array('field' => '123'), $this->definitionCreator->create(EntityWithSingleInt::class));

        $this->assertEquals(123, $result->getField());
    }

    public function testIgnoresUnknownFields()
    {
        $result = $this->mapper->map(array('field' => '123'), $this->definitionCreator->create(EmptyEntity::class));

        $this->assertEquals(new EmptyEntity(), $result);
    }

    /**
     * @expectedException \Agares\MicroORM\UnknownFieldTypeException
     */
    public function testThrowsIfTypeOfFieldIsUnknown()
    {
        $this->mapper->map(array('field' => '123'), $this->definitionCreator->create(EntityWithCustomType::class));
    }

    public function testeMapsComplexGetterOntoFieldName()
    {
        $this->mapper->map(['some_complex_field' => 'aaa'], $this->definitionCreator->create(EntityWithComplexFieldName::class));
    }
}
