<?php
declare(strict_types=1);

namespace Agares\MicroORMTests;

use Agares\MicroORM\EntityMapper;
use Agares\MicroORMTests\Stubs\EmptyEntity;
use Agares\MicroORMTests\Stubs\EntityWithoutParameterlessConstructor;
use Agares\MicroORMTests\Stubs\EntityWithParameterlessConstructor;
use Agares\MicroORMTests\Stubs\EntityWithSingleString;

class EntityMapperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EntityMapper
     */
    private $mapper;

    public function setUp()
    {
        $this->mapper = new EntityMapper();
    }

    public function testCanMapIntoTargetType()
    {
        $result = $this->mapper->map(array(), EmptyEntity::class);

        $this->assertInstanceOf(EmptyEntity::class, $result);
    }

    public function testCanMapPrivateStringField()
    {
        $fieldValue = 'test';

        /** @var EntityWithSingleString $result */
        $result = $this->mapper->map(array('field' => $fieldValue), EntityWithSingleString::class);

        $this->assertEquals($fieldValue, $result->getField());
    }

    public function testCanMapEntityWithoutParameterlessConstructor()
    {
        $fieldValue = 'test';

        /** @var EntityWithoutParameterlessConstructor $result */
        $result = $this->mapper->map(array('field' => $fieldValue), EntityWithoutParameterlessConstructor::class);

        $this->assertEquals($fieldValue, $result->getField());
    }

    public function testParameterlessConstructorIsExecuted()
    {
        /** @var EntityWithParameterlessConstructor $result */
        $result = $this->mapper->map(array(), EntityWithParameterlessConstructor::class);

        $this->assertTrue($result->wasConstructorCalled());
    }
}
