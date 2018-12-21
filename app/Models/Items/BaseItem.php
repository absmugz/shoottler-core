<?php

namespace App;

use App\Models\BaseModel;
use App\Models\Items\Service;


abstract class BaseItem extends BaseModel
{
	protected $table = 'items';

	protected $fillable =
		[
			'company_id',
			'resource_id',
			'name',
			'description',
			'from_zone_id',
			'to_zone_id',
			'is_drafted'
		];
	protected static $persisted =
		[
			'company_id',
			'resource_id',
			'name',
			'description',
			'price',
			'discount',
			'is_drafted'
		];
	public $searchableColumns = [
		'name','description'
	];
	protected static $logFillable = true;
	protected static $logOnlyDirty = true;
	protected static $singleTableSubclasses = [
		Service::class
	];
}
