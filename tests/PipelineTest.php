<?php

namespace RealPHPFP;
include_once (__DIR__ . '/../src/Pipeline.php');

use PHPUnit\Framework\TestCase;

class PipelineTest extends TestCase
{

	public function testResolve()
	{
		$double = function($num) { return $num * 2; };
		$minus2 = function($num) { return $num - 2; };
		$pipeline = new Pipeline(
			$double,
			$minus2
		);

		$this->assertEquals(18, $pipeline->resolve(10));
	}

	public function testResolveWithCallbackStrings() {
		$addItem = function ($arr) {
			return array_merge($arr, [5]);
		};

		$pipeline = new Pipeline(
			$addItem,
			'array_sum'
		);

		$this->assertEquals(10, $pipeline->resolve([5]));
	}
}
