<?php
/**
 * Created by PhpStorm.
 * User: Will Busby
 * Date: 28/05/2018
 */

namespace RealPHPFP;
include_once (__DIR__ . '/../src/Middleware.php');
include_once (__DIR__ . '/../src/Pipeline.php');

use PHPUnit\Framework\TestCase;

class MiddlewareTest extends TestCase
{

	public function testIfNotNullReturnsValueWhenNotNull()
	{
		$resolvesIfNotNull = function($value) { return $value * 2; };
		$cb = Middleware::IfNotNull($resolvesIfNotNull);

		$this->assertEquals(20, $cb(10));
	}

	public function testIfNotNullWorksWithPiplineAndDoesntCallCallback() {
		$resolvesNull = function() { return null; };
		$double = function($value) { return $value * 2; };
		$pipeline = new Pipeline(
			$resolvesNull,
			Middleware::IfNotNull($double)
		);

		$this->assertNull($pipeline->resolve(10));
	}

	public function testIfNotNullWorksWithPipelineAndCallsCallback() {
		$double = function($value) { return $value * 2; };
		$minus5 = function($value) { return $value - 5; };
		$pipeline = new Pipeline(
			$double,
			$minus5
		);

		$this->assertEquals(15, $pipeline->resolve(10));
	}
}
