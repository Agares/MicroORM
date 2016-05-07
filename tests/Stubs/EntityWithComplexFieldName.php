<?php

namespace Agares\MicroORMTests\Stubs;

class EntityWithComplexFieldName
{
	private $someComplexField;

	public function getSomeComplexField() : int
	{
		return $this->someComplexField;
	}
}