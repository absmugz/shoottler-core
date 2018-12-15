<?php

namespace App\Models\Items\Services\Extras;

use App\Contracts\ExtraServiceContract;
use App\Models\Items\Service;

class Extra extends Service implements ExtraServiceContract
{
	protected static $singleTableType = Extra::class;

	protected static $persisted =
		[
		];
	/**
	 * This class is used to group to main type of
	 * Extras
	 * @var array
	 */
	protected static $singleTableSubclasses = [

	];

}
