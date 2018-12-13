<?php

namespace App\Models\Resources\Vehicles;

use App\Contracts\VehicleContract;
use App\Models\Area\Area;
use App\Models\Company\Company;
use App\Models\Resources\Resource;
use App\Traits\Amenitytable;
use App\Traits\hasFeaturedImage;
use App\Traits\hasGallery;
use App\Traits\isVehicle;

class Vehicle extends Resource implements VehicleContract
{
	use isVehicle;
	use hasFeaturedImage;
	use hasGallery;
	use Amenitytable;

    protected static $singleTableType = Vehicle::class;

	protected static $persisted =
		[
			'make',
			'model',
			'year'
		];
	/**
	 * This vehicle's area
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function company(){
		return $this->belongsTo(Company::class);
	}
}
