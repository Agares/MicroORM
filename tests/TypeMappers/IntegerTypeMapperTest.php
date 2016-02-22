<?php
declare(strict_types = 1);

namespace Agares\MicroORMTests\TypeMappers;

use Agares\MicroORM\TypeMappers\IntegerTypeMapper;

class IntegerTypeMapperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testMapsInteger($input, $expected)
    {
        $typeMapper = new IntegerTypeMapper();
        $result = $typeMapper->fromString($input);

        $this->assertEquals($expected, $result);
    }

    public function dataProvider() : array
    {
        return [
            ['11', 11],
            ['13', 13],
            ['66', 66],
            ['aaaa', 0]
        ];
    }
}
