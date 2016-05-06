<?php

namespace Agares\MicroORMTests\FieldNameMappers;

use Agares\MicroORM\FieldNameMappers\StripGet;

class StripGetFromFieldNameMapperTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var StripGet
	 */
	private $fieldNameMapper;

	public function setUp()
	{
		$this->fieldNameMapper = new StripGet();
	}

	public function testStripsGetFromSingleWord()
	{
		$mappedName = $this->fieldNameMapper->map('getSomething');

		$this->assertEquals('something', $mappedName);
	}

	public function testMultipleWordsAreLeftInCamelCase()
	{
		$mappedName = $this->fieldNameMapper->map('getSomeThing');

		$this->assertEquals('someThing', $mappedName);
	}
}