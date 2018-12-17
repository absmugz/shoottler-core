<?php

namespace App\Models\Items\Services;

use App\Contracts\PrivateTransferContract;
use App\Models\Items\Transfer;

class PrivateTransfer extends Transfer implements PrivateTransferContract
{
	protected static $singleTableType = PrivateTransfer::class;

	protected static $persisted =
		[
		];
	/**
	 * This class is used to group to main type of
	 * Private Transfer
	 * @var array
	 */
	protected static $singleTableSubclasses = [

	];
	/**
	 * This Item's name
	 * @return array
	 */
	public function itemName() {
		return ['singular'=>'Private Transfer','plural' => 'Private Transfers'];
	}
}
