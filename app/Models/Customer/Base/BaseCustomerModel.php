<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 2018-12-17
 * Time: 19:56
 */

namespace App\Models\Customer\Base;

use App\Models\BaseModel;
use App\Models\Customer\AgencyCustomer;
use App\Models\Customer\RetailCustomer;


abstract class BaseCustomerModel extends BaseModel {
	protected $table = 'customers';
	protected $fillable = [
		'company_id',
		'name',
		'email'
	];
	protected $searchableColumns = [
		'name',
		'email'
	];
	protected static $persisted =
		[
			'company_id',
			'name',
			'email'
		];
	protected static $logFillable = true;
	protected static $logOnlyDirty = true;
	protected static $singleTableSubclasses = [
		RetailCustomer::class,AgencyCustomer::class
	];
}