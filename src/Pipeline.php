<?php

namespace RealPHPFP;


class Pipeline
{

	private $callbacks;

	public function __construct()
	{
		$this->callbacks = func_get_args();
	}

	public function resolve($value) {
		return array_reduce(
			array_slice($this->callbacks, 1),
			function($carry, $callback) { return call_user_func($callback, $carry); },
			call_user_func($this->callbacks[0], $value)
		);
	}

}