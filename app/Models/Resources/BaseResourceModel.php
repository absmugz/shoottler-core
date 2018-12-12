<?php

namespace App\Models\Resources;

use App\Models\BaseModel;
use App\Models\Resources\Vehicles\Vehicle;


abstract class BaseResourceModel extends BaseModel
{
	protected $table = 'resources';

	protected $fillable =
		[
			'area_id',
			'name',
			'description',
			'make',
			'model',
			'year',
			'capacity',
		];
	protected static $persisted =
		[
			'area_id',
			'name',
			'description',
			'capacity',
		];
	public $searchableColumns = [
		'name','description'
	];
	protected static $logFillable = true;
	protected static $logOnlyDirty = true;
	protected static $singleTableSubclasses = [
		Vehicle::class
	];
}
