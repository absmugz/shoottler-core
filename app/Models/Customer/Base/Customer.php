<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 2018-12-17
 * Time: 21:01
 */

namespace App\Models\Customer\Base;


use App\Traits\HasBookings;

class Customer extends BaseCustomerModel {
	use HasBookings;
	public static $rules = [

	];

}