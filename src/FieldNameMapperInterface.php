<?php

namespace Agares\MicroORM;

/**
 * Implementors should map getter name onto an alias from executed query.
 */
interface FieldNameMapperInterface
{
	public function map(string $getterName) : string;
}