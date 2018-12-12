<?php

namespace App\Models\Resources\Vehicles;

use App\Contracts\VehicleContract;
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
}
