<?php

declare(strict_types=1);

namespace Agares\MicroORM\FieldNameMappers;

use Agares\MicroORM\FieldNameMapperInterface;

final class StripGet implements FieldNameMapperInterface
{
	public function map(string $getterName) : string
	{
		return lcfirst(substr($getterName, 3));
	}
}