<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 2018-12-17
 * Time: 20:11
 */

namespace App\Models\Customer;

use App\Models\Customer\Base\Customer;

class RetailCustomer extends Customer {
	protected static $singleTableType = RetailCustomer::class;

	protected static $persisted =
		[

		];
	/**
	 * This Customer Type's name
	 * @return array
	 */
	public function customerTypeName() {
		return ['singular' => 'Retail Customer','plural' => 'Retail Customers'];
	}
}