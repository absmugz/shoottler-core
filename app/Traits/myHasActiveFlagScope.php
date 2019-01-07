<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 9/30/18
 * Time: 8:31 PM
 */

namespace App\Traits;


use App\Scopes\myActiveFlagScope;

trait myHasActiveFlagScope {
	/**
	 * Boot the HasActiveFlagScope trait for a model.
	 *
	 * @return void
	 */
	public static function bootHasActiveFlagScope()
	{
		static::addGlobalScope(new myActiveFlagScope);
	}
}