<?php
declare(strict_types = 1);

namespace Agares\MicroORMTests;

use Agares\MicroORM\EntityDefinition;
use Agares\MicroORM\EntityDefinitionCreator;
use Agares\MicroORM\EntityFieldDefinition;
use Agares\MicroORM\FieldNameMappers\ToUnderscores;
use Agares\MicroORMTests\Stubs\EntityWithMethod;
use Agares\MicroORMTests\Stubs\EntityWithSingleDateTime;
use Agares\MicroORMTests\Stubs\EntityWithSingleInt;
use Agares\MicroORMTests\Stubs\EntityWithSingleString;

class EntityDefinitionCreatorTest extends \PHPUnit_Framework_TestCase
{
    /** @var EntityDefinitionCreator */
    private $definitionCreator;

    public function setUp()
    {
        $this->definitionCreator = new EntityDefinitionCreator(new ToUnderscores());
    }

    public function testCanCreateADefinitionFromGetters()
    {
        $definition = $this->definitionCreator->create(EntityWithSingleString::class);

        $expectedDefinition = new EntityDefinition(EntityWithSingleString::class);
        $expectedDefinition->addField(new EntityFieldDefinition('field', 'string'));

        $this->assertEquals($expectedDefinition, $definition);
    }

    public function testCanCreateADefinitionForIntegerField()
    {
        $definition = $this->definitionCreator->create(EntityWithSingleInt::class);

        $expectedDefinition = new EntityDefinition(EntityWithSingleInt::class);
        $expectedDefinition->addField(new EntityFieldDefinition('field', 'int'));

        $this->assertEquals($expectedDefinition, $definition);
    }

    public function testCanCreateADefinitionForDateTimeField()
    {
        $definition = $this->definitionCreator->create(EntityWithSingleDateTime::class);

        $expectedDefinition = new EntityDefinition(EntityWithSingleDateTime::class);
        $expectedDefinition->addField(new EntityFieldDefinition('field', 'DateTime'));

        $this->assertEquals($expectedDefinition, $definition);
    }

    public function testMethodsThatNamesDontStartWithGetAreIgnored()
    {
        $definition = $this->definitionCreator->create(EntityWithMethod::class);

        $expectedDefinition = new EntityDefinition(EntityWithMethod::class);

        $this->assertEquals($expectedDefinition, $definition);
    }
}