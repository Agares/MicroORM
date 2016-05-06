<?php

namespace Agares\MicroORM\FieldNameMappers;

use Agares\MicroORM\FieldNameMapperInterface;

class StripGet implements FieldNameMapperInterface
{
	public function map(string $getterName) : string
	{
		return lcfirst(substr($getterName, 3));
	}
}