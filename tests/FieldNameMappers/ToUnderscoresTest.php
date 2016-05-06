<?php

namespace Agares\MicroORMTests\FieldNameMappers;

use Agares\MicroORM\FieldNameMapperInterface;
use Agares\MicroORM\FieldNameMappers\ToUnderscores;

class ToUnderscoresTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var FieldNameMapperInterface
	 */
	private $fieldNameMapper;

	public function setUp()
	{
		$this->fieldNameMapper = new ToUnderscores();
	}

	/**
	 * @dataProvider namesToConvert
	 */
	public function testConversion($from, $to)
	{
		$result = $this->fieldNameMapper->map($from);

		$this->assertEquals($to, $result);
	}

	public function namesToConvert()
	{
		return [
			['getSomething', 'something'],
			['getSomeThing', 'some_thing'],
			['getMultipleWordsAndSomeOtherWordsAndStuffYouKnow', 'multiple_words_and_some_other_words_and_stuff_you_know'],
		];
	}
}