<?php

namespace App\Models\Items;

use App\Contracts\ServiceContract;
use App\Models\Items\Services\Extras\Extra;
use App\Traits\Bookable;
use App\Traits\hasFeaturedImage;
use App\Traits\hasGallery;
use App\Traits\isService;

class Service extends Item implements ServiceContract
{
	use isService;
	use hasFeaturedImage;
	use hasGallery;
	use Bookable;

	protected static $singleTableType = Service::class;

	protected static $persisted =
		[
			'duration'
		];
	/**
	 * This class is used to group to main type of
	 * Services
	 * @var array
	 */
	protected static $singleTableSubclasses = [
		Extra::class,Tour::class,Transfer::class,Arrival::class,Departure::class,RoundTrip::class
	];

}
