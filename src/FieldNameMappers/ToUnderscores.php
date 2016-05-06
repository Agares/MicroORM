<?php

namespace Agares\MicroORM\FieldNameMappers;

use Agares\MicroORM\FieldNameMapperInterface;

class ToUnderscores implements FieldNameMapperInterface
{
	public function map(string $getterName) : string
	{
		return preg_replace_callback('/[A-Z]/', function($x) { return '_'.strtolower($x[0]); }, lcfirst(substr($getterName, 3)));
	}
}