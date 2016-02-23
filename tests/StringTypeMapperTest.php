<?php
declare(strict_types = 1);

namespace Agares\MicroORMTests;

use Agares\MicroORM\TypeMappers\StringTypeMapper;

class StringTypeMapperTest extends \PHPUnit_Framework_TestCase
{
    public function testReturnsTheStringAsIs()
    {
        $inputString = 'aaa';

        $typeMapper = new StringTypeMapper();
        $result = $typeMapper->fromString('a', array('a' => $inputString));

        $this->assertEquals($inputString, $result);
    }
}