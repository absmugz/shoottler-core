<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 2018-12-17
 * Time: 20:12
 */

namespace App\Models\Customer;


use App\Models\Customer\Base\Customer;

class AgencyCustomer extends Customer {
	protected static $singleTableType = AgencyCustomer::class;

	protected static $persisted =
		[

		];
	/**
	 * This Customer Type's name
	 * @return array
	 */
	public function customerTypeName() {
		return ['singular' => 'Agency Customer','plural' => 'Agency Customers'];
	}
}