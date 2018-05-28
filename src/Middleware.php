<?php
/**
 * Created by PhpStorm.
 * User: Will Busby
 * Date: 28/05/2018
 */

namespace RealPHPFP;

class Middleware
{
	public static function IfNotNull(callable $callback): callable {
		return function($value) use ($callback) {

			if (!is_null($value)) {
				return $callback($value);
			}

			return $value;
		};
	}
}