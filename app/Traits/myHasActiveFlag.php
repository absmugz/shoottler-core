<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 9/30/18
 * Time: 8:28 PM
 */

namespace App\Traits;


use Cog\Flag\Traits\Classic\HasActiveFlagHelpers;

trait myHasActiveFlag {

	use HasActiveFlagHelpers;
	use myHasActiveFlagScope;

}