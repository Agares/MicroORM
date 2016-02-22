<?php
declare(strict_types = 1);

namespace Agares\MicroORMTests;

use Agares\MicroORM\EntityDefinitionCreator;
use Agares\MicroORMTests\Stubs\EntityWithSingleDateTime;
use Agares\MicroORMTests\Stubs\EntityWithSingleInt;
use Agares\MicroORMTests\Stubs\EntityWithSingleString;

class EntityDefinitionCreatorTest extends \PHPUnit_Framework_TestCase
{
    /** @var EntityDefinitionCreator */
    private $definitionCreator;

    public function setUp()
    {
        $this->definitionCreator = new EntityDefinitionCreator();
    }

    public function testCanCreateADefinitionFromGetters()
    {
        $definition = $this->definitionCreator->create(EntityWithSingleString::class);

        $this->assertEquals(['field' => ['type' => 'string']], $definition['fields']);
    }

    public function testCanCreateADefinitionForIntegerField()
    {
        $definition = $this->definitionCreator->create(EntityWithSingleInt::class);

        $this->assertEquals(['field' => ['type' => 'int']], $definition['fields']);
    }

    public function testCanCreateADefinitionForDateTimeField()
    {
        $definition = $this->definitionCreator->create(EntityWithSingleDateTime::class);

        $this->assertEquals(['field' => ['type' => 'DateTime']], $definition['fields']);
    }

    public function testSavesTheEntityName()
    {
        $definition = $this->definitionCreator->create(EntityWithSingleString::class);

        $this->assertEquals(EntityWithSingleString::class, $definition['class_name']);
    }
}